<?php
declare(strict_types=1);

namespace App\Infrastructure\DriverAdapter;

use App\Domain\DrivenPort\IFetchProducts;
use App\Domain\DriverPort\IProvideProductDetail;
use App\Domain\Product;

final readonly class ProductDetailProvider implements IProvideProductDetail
{
    public function __construct(private IFetchProducts $productFetcher) {}

    public function get(string $id): Product
    {
        return $this->productFetcher->fetchById($id);
    }
}
