<?php
declare(strict_types=1);

namespace App\Domain\DrivenAdapter;

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
                    $product['name'],
                    $product['description'],
                    (float) $product['price'],
                    (int) $product['category_id']
                ),
                $products
            )
        );
    }
}
