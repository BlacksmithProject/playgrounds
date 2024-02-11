<?php
declare(strict_types=1);

namespace App\Infrastructure\HTTP;

use App\Domain\DriverPort\IProvideCatalog;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final readonly class GetCatalog
{
    public function __construct(private IProvideCatalog $catalogProvider) {}

    #[Route('/catalog', name: 'catalog', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        return new JsonResponse($this->catalogProvider->get());
    }
}
