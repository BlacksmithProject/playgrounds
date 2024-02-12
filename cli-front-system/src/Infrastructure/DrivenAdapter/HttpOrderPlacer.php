<?php
declare(strict_types=1);

namespace App\Infrastructure\DrivenAdapter;

use App\Domain\DrivenPort\IPlaceOrders;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final readonly class HttpOrderPlacer implements IPlaceOrders
{
    public function __construct(private HttpClientInterface $omsApiClient) {}

    public function placeOrder(array $order): void
    {
        $response = $this->omsApiClient->request('POST', '/orders', [
            'json' => [
                'productId' => $order['productId'],
                'quantity' => $order['quantity'],
                'unitPrice' => $order['unitPrice'],
            ]
        ]);

        if (201 !== $response->getStatusCode()) {
            throw new \RuntimeException('Order could not be placed');
        }
    }
}
