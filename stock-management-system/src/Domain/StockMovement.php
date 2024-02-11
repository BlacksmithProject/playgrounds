<?php
declare(strict_types=1);

namespace App\Domain;

enum StockMovement: string
{
    case IN = 'IN';
    case OUT = 'OUT';
    case SET_ASIDE = 'SET_ASIDE';
    case RE_INCORPORATE = 'RE_INCORPORATE';
}
