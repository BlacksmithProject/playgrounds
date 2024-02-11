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
            $stockItem = $this->connection->createQueryBuilder()
                ->select('*')
                ->from('stock_items')
                ->where('product_id = :product_id')
                ->setParameter('product_id', $productId)
                ->executeQuery()
                ->fetchAssociative();
            $this->connection->update('stock_items', [
                'quantity' => $stockItem['quantity'] - $quantity,
                ], [
                    'product_id' => $productId,
                ],
            );

            $this->connection->insert('stock_movements', [
                'stock_item_id' => $stockItem['id'],
                'type' => StockMovement::SET_ASIDE->value,
                'quantity' => $quantity,
                'reason' => 'RAS',
                'movement_date' => (new \DateTimeImmutable())->format('Y-m-d H:i:s'),
            ]);
            $this->connection->commit();
        } catch (Exception $e) {
            $this->connection->rollBack();

            throw $e;
        }
    }
}
