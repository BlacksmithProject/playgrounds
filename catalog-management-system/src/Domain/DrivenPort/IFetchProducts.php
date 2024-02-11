<?php
declare(strict_types=1);

namespace App\Domain\DrivenPort;

use App\Domain\Product;
use App\Domain\ProductCollection;

interface IFetchProducts
{
    public function fetchAll(): ProductCollection;

    public function fetchById(string $id): Product;
}
