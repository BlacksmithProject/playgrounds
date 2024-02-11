<?php
declare(strict_types=1);

namespace App\Domain\DrivenPort;

use App\Domain\Exception\InsufficientStock;

interface IBookProduct
{
    /** @throws InsufficientStock */
    public function book(string $productId, int $quantity): void;
}
