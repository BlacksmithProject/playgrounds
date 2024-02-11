<?php
declare(strict_types=1);

namespace App\Domain\DrivenPort;

use App\Domain\Exception\ProductNotFound;

interface IFetchProductDetails
{
    /** @throws ProductNotFound */
    public function get(string $productId): array;
}
