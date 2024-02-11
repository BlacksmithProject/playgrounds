<?php
declare(strict_types=1);

namespace App\Domain\DrivenPort;

use App\Domain\StockMovement;

interface ITrackStockMovements
{
    public function setAside(string $productId, int $quantity): void;
}
