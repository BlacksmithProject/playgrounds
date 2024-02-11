<?php
declare(strict_types=1);

namespace App\Domain\DrivenPort;

interface IBookProduct
{
    public function book(string $productId, int $quantity): void;
}
