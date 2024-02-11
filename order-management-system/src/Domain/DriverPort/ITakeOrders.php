<?php
declare(strict_types=1);

namespace App\Domain\DriverPort;

use App\Domain\Exception\OrderFailed;

interface ITakeOrders
{
    /** @throws OrderFailed */
    public function take(string $productId, int $quantity, float $unitPrice): void;
}
