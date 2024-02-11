<?php
declare(strict_types=1);

namespace App\Domain;

final class OrderItem
{
    public function __construct(
        public string $id,
        public string $productId,
        public int $quantity,
        public float $pricePerUnit,
    ) {}

    public function totalPrice(): float
    {
        return $this->quantity * $this->pricePerUnit;
    }
}
