<?php
declare(strict_types=1);

namespace App\Domain;

final class Product implements \JsonSerializable
{
    public function __construct(
        public string $name,
        public string $description,
        public float $price,
        public int $categoryId
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'categoryId' => $this->categoryId,
        ];
    }
}
