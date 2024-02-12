<?php
declare(strict_types=1);

namespace App\Domain\DrivenPort;

interface IPublishMessages
{
    public function publish(array $data, string $messageType): void;
}
