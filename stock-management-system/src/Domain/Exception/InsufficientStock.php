<?php
declare(strict_types=1);

namespace App\Domain\Exception;

final class InsufficientStock extends \DomainException
{
    public function __construct(string $message = "", int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function fromDemand(string $productId, int $quantity): self
    {
        return new self(sprintf('Insufficient stock for product %s. Current stock: %d', $productId, $quantity));
    }
}
