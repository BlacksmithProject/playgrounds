<?php
declare(strict_types=1);

namespace App\Domain;

final class ProductCollection implements \JsonSerializable
{
    /** @var Product[] */
    private array $products;

    public function __construct(Product...$products)
    {
        $this->products = $products;
    }

    public function jsonSerialize(): array
    {
        return $this->products;
    }
}
