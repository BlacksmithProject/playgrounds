<?php
declare(strict_types=1);

namespace App\Infrastructure\DriverAdapter;

use App\Domain\DrivenPort\IBookProduct;
use App\Domain\DrivenPort\IFetchProductDetails;
use App\Domain\DrivenPort\IProvideIdentifiers;
use App\Domain\DrivenPort\IStoreOrders;
use App\Domain\DriverPort\ITakeOrders;
use App\Domain\Exception\InsufficientStock;
use App\Domain\Exception\OrderFailed;
use App\Domain\Exception\ProductNotFound;
use App\Domain\Order;
use App\Domain\OrderItem;

final readonly class OrderTaker implements ITakeOrders
{
    public function __construct(
        private IFetchProductDetails $productDetailsFetcher,
        private IBookProduct $productBooker,
        private IStoreOrders $orderStorage,
        private IProvideIdentifiers $idProvider
    ) {}

    /** @throws OrderFailed */
    public function take(string $productId, int $quantity, float $unitPrice): void
    {
        try {
            $productDetails = $this->productDetailsFetcher->get($productId);
            $productPrice = $productDetails['price'];

            if ($productPrice > $unitPrice) {
                throw new OrderFailed();
            }

            $total = $productPrice * $quantity;
            $order = new Order(
                $this->idProvider->generate(),
                'pending',
                $total,
                new OrderItem(
                    $this->idProvider->generate(),
                    $productId,
                    $quantity,
                    $productPrice
                )
            );
            $this->productBooker->book($productId, $quantity);
            $this->orderStorage->store($order);
        } catch (InsufficientStock|ProductNotFound $e) {
            throw new OrderFailed();
        }
    }
}
