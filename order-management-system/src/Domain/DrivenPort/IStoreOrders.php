<?php
declare(strict_types=1);

namespace App\Domain\DrivenPort;

use App\Domain\Order;

interface IStoreOrders
{
    public function store(Order $order): void;
}
