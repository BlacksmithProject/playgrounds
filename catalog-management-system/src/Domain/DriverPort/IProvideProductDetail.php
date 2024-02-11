<?php
declare(strict_types=1);

namespace App\Domain\DriverPort;

use App\Domain\Product;

interface IProvideProductDetail
{
    public function get(string $id): Product;
}
