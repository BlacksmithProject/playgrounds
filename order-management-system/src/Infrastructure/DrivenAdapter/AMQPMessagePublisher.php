<?php
declare(strict_types=1);

namespace App\Infrastructure\DrivenAdapter;

use App\Domain\DrivenPort\IPublishMessages;
use Swarrot\Broker\Message;
use Swarrot\SwarrotBundle\Broker\Publisher;

final readonly class AMQPMessagePublisher implements IPublishMessages
{
    public function __construct(private Publisher $publisher) {}

    public function publish(array $data, string $messageType): void
    {
        $this->publisher->publish($messageType, new Message(json_encode($data)));
    }
}
