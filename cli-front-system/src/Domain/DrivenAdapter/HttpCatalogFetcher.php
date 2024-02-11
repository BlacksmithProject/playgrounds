<?php
declare(strict_types=1);

namespace App\Domain\DrivenAdapter;

use App\Domain\DrivenPort\IFetchCatalog;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final readonly class HttpCatalogFetcher implements IFetchCatalog
{
    public function __construct(private HttpClientInterface $cmsApiClient)
    {
    }

    public function fetchCatalog(): array
    {
        $response = $this->cmsApiClient->request('GET', '/catalog');

        return $response->toArray();
    }
}
