<?php
declare(strict_types=1);

namespace App\Domain\DriverPort;

use App\Domain\ProductCollection;

interface IProvideCatalog
{
    public function get(): ProductCollection;
}
