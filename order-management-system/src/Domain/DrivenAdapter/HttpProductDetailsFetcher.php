<?php
declare(strict_types=1);

namespace App\Domain\DrivenAdapter;

use App\Domain\DrivenPort\IFetchProductDetails;
use App\Domain\Exception\ProductNotFound;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final readonly class HttpProductDetailsFetcher implements IFetchProductDetails
{
    public function __construct(private HttpClientInterface $cmsApiClient) {}

    /**
     * @throws ProductNotFound
     */
    public function get(string $productId): array
    {
        $response = $this->cmsApiClient->request('GET', '/catalog/'.$productId);

        if ($response->getStatusCode() === 404) {
            throw new ProductNotFound();
        }

        return $response->toArray();
    }
}
