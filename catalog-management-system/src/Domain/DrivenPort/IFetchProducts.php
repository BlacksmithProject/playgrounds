<?php
declare(strict_types=1);

namespace App\Domain\DrivenPort;

use App\Domain\ProductCollection;

interface IFetchProducts
{
    public function fetchAll(): ProductCollection;
}
