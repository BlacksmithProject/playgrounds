<?php
declare(strict_types=1);

namespace App\Domain\DrivenPort;

interface IProvideIdentifiers
{
    public function generate(): string;
}
