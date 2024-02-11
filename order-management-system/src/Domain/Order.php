<?php
declare(strict_types=1);

namespace App\Domain;

final class Order
{
    public function __construct(
        public string $id,
        public string $status,
        public float $total,
        public OrderItem $orderItem,
    ) {}
}
