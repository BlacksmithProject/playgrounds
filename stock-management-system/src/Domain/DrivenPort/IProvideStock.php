<?php
declare(strict_types=1);

namespace App\Domain\DrivenPort;

interface IProvideStock
{
    public function getQuantityForProduct(string $productId): int;
}
