<?php
declare(strict_types=1);

namespace App\Infrastructure\DrivenAdapter;

use App\Domain\DrivenPort\IBookProduct;
use App\Domain\Exception\InsufficientStock;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final readonly class HttpProductBooker implements IBookProduct
{
    public function __construct(private HttpClientInterface $smsApiClient) {}

    /** @throws InsufficientStock */
    public function book(string $productId, int $quantity): void
    {
        $response = $this->smsApiClient->request('POST', sprintf('/products/%s/book', $productId), [
            'json' => ['quantity' => $quantity],
        ]);


        if (201 !== $response->getStatusCode()) {
            throw new InsufficientStock();
        }
    }
}
