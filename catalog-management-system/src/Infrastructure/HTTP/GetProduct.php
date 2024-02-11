<?php
declare(strict_types=1);

namespace App\Infrastructure\HTTP;

use App\Domain\DriverPort\IProvideProductDetail;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final readonly class GetProduct
{
    public function __construct(private IProvideProductDetail $productDetailProvider) {}

    #[Route('/catalog/{productId}', name: 'get_product', methods: ['GET'])]
    public function __invoke(string $productId): JsonResponse
    {
        $product = $this->productDetailProvider->get($productId);

        return new JsonResponse($product);
    }
}
