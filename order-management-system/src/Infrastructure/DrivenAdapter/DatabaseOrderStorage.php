<?php
declare(strict_types=1);

namespace App\Infrastructure\DrivenAdapter;

use App\Domain\DrivenPort\IStoreOrders;
use App\Domain\Order;
use Doctrine\DBAL\Connection;

final readonly class DatabaseOrderStorage implements IStoreOrders
{
    public function __construct(private Connection $connection) {}


    public function store(Order $order): void
    {
        try {
            $this->connection->beginTransaction();
            $this->connection->insert('orders', [
                'id' => $order->id,
                'status' => $order->status,
                'total' => $order->total,
            ]);
            $this->connection->insert('order_items', [
                'id' => $order->orderItem->id,
                'order_id' => $order->id,
                'product_id' => $order->orderItem->productId,
                'quantity' => $order->orderItem->quantity,
                'price_per_unit' => $order->orderItem->pricePerUnit,
                'total_price' => $order->orderItem->totalPrice(),
            ]);
            $this->connection->commit();
        } catch (\Throwable $e) {
            $this->connection->rollBack();
            throw $e;
        }
    }
}
