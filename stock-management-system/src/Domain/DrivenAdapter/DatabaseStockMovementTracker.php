<?php
declare(strict_types=1);

namespace App\Domain\DrivenAdapter;

use App\Domain\DrivenPort\ITrackStockMovements;
use App\Domain\StockMovement;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

final class DatabaseStockMovementTracker implements ITrackStockMovements
{
    public function __construct(private readonly Connection $connection) {}

    public function setAside(string $productId, int $quantity): void
    {
        try {
            $this->connection->beginTransaction();
            $this->connection->update('stock_items', [
                'quantity' => 'quantity - :quantity',
                ], [
                    'product_id' => $productId,
                    'quantity' => $quantity,
                ],
            );
            $this->connection->insert('stock_movements', [
                'stock_item_id' => $productId,
                'type' => StockMovement::SET_ASIDE,
                'quantity' => $quantity,
                'reason' => 'RAS',
                'created_at' => (new \DateTimeImmutable())->format('Y-m-d H:i:s'),
            ]);
            $this->connection->commit();
        } catch (Exception $e) {
            $this->connection->rollBack();

            throw $e;
        }
    }
}
