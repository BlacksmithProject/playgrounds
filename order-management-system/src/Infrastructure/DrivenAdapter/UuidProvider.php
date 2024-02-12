<?php
declare(strict_types=1);

namespace App\Infrastructure\DrivenAdapter;

use App\Domain\DrivenPort\IProvideIdentifiers;
use Symfony\Component\Uid\Uuid;

final class UuidProvider implements IProvideIdentifiers
{
    public function generate(): string
    {
        return Uuid::v4()->toRfc4122();
    }
}
