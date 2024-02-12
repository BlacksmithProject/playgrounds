<?php
declare(strict_types=1);

namespace App\Infrastructure\DrivenAdapter;

use App\Domain\DrivenPort\IFetchProducts;
use App\Domain\Product;
use App\Domain\ProductCollection;
use Doctrine\DBAL\Connection;

final readonly class DatabaseProductFetcher implements IFetchProducts
{
    public function __construct(private Connection $connection)
    {
    }

    public function fetchAll(): ProductCollection
    {
        $products = $this->connection->fetchAllAssociative('SELECT * FROM products');

        return new ProductCollection(
            ...array_map(
                fn (array $product) => new Product(
                    $product['id'],
                    $product['name'],
                    $product['description'],
                    (float) $product['price'],
                    $product['category_id']
                ),
                $products
            )
        );
    }

    public function fetchById(string $id): Product
    {
        $product = $this->connection->fetchAssociative('SELECT * FROM products WHERE id = :id', ['id' => $id]);

        return new Product(
            $product['id'],
            $product['name'],
            $product['description'],
            (float) $product['price'],
            $product['category_id']
        );
    }
}
