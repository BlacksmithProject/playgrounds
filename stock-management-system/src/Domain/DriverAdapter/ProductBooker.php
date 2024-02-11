<?php
declare(strict_types=1);

namespace App\Domain\DriverAdapter;

use App\Domain\DrivenPort\IProvideStock;
use App\Domain\DrivenPort\ITrackStockMovements;
use App\Domain\DriverPort\IBookProducts;
use App\Domain\Exception\InsufficientStock;

final readonly class ProductBooker implements IBookProducts
{
    public function __construct(
        private IProvideStock $stockProvider,
        private ITrackStockMovements $stockMovements
    ) {}

    /** @throws InsufficientStock */
    public function bookProduct(string $productId, int $quantity): void
    {
        if ($this->stockProvider->getQuantityForProduct($productId) < $quantity) {
            throw InsufficientStock::fromDemand($productId, $quantity);
        }
        $this->stockMovements->setAside($productId, $quantity);
    }
}
