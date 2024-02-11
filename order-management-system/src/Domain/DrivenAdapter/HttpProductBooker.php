<?php
declare(strict_types=1);

namespace App\Domain\DrivenAdapter;

use App\Domain\DrivenPort\IBookProduct;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final readonly class HttpProductBooker implements IBookProduct
{
    public function __construct(private HttpClientInterface $smsApiClient) {}

    public function book(string $productId, int $quantity): void
    {
        $response = $this->smsApiClient->request('POST', sprintf('/products/%s/book', $productId), [
            'json' => ['quantity' => $quantity],
        ]);

        if (200 !== $response->getStatusCode()) {
            throw new \RuntimeException('Failed to book product');
        }
    }
}
