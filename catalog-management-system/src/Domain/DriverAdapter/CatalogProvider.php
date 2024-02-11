<?php
declare(strict_types=1);

namespace App\Domain\DriverAdapter;

use App\Domain\DrivenPort\IFetchProducts;
use App\Domain\DriverPort\IProvideCatalog;
use App\Domain\ProductCollection;

final readonly class CatalogProvider implements IProvideCatalog
{
    public function __construct(private IFetchProducts $fetchProducts)
    {
    }

    public function get(): ProductCollection
    {
        return $this->fetchProducts->fetchAll();
    }
}
