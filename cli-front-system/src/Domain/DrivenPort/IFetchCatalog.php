<?php
declare(strict_types=1);

namespace App\Domain\DrivenPort;

interface IFetchCatalog
{
    public function fetchCatalog(): array;
}
