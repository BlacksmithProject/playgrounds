<?php
declare(strict_types=1);

namespace App\Domain\DriverPort;

use App\Domain\Exception\InsufficientStock;

interface IBookProducts
{
    /** @throws InsufficientStock */
    public function bookProduct(string $productId, int $quantity): void;
}
