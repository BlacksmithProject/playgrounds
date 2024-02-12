<?php
declare(strict_types=1);

namespace App\Infrastructure\DrivenAdapter;

use App\Domain\DrivenPort\IProvideStock;
use Doctrine\DBAL\Connection;

final readonly class DatabaseStockProvider implements IProvideStock
{
    public function __construct(private Connection $connection) {}

    public function getQuantityForProduct(string $productId): int
    {
        $this->connection->createQueryBuilder();
        $quantity = $this->connection->createQueryBuilder()
            ->select('quantity')
            ->from('stock_items')
            ->where('product_id = :product_id')
            ->setParameter('product_id', $productId)
            ->executeQuery()
            ->fetchOne();

        return $quantity ?? 0;
    }
}
