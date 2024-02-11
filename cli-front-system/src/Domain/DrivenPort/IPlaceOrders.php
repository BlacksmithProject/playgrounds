<?php
declare(strict_types=1);

namespace App\Domain\DrivenPort;

interface IPlaceOrders
{
    public function placeOrder(array $order): void;
}
