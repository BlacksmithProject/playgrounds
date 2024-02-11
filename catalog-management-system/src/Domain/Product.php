<?php
declare(strict_types=1);

namespace App\Domain;

final class Product implements \JsonSerializable
{
    public function __construct(
        public string $id,
        public string $name,
        public string $description,
        public float $price,
        public string $categoryId
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'categoryId' => $this->categoryId,
        ];
    }
}
