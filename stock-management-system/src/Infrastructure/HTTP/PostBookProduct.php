<?php
declare(strict_types=1);

namespace App\Infrastructure\HTTP;

use App\Domain\DriverPort\IBookProducts;
use App\Domain\Exception\InsufficientStock;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final readonly class PostBookProduct
{
    public function __construct(private IBookProducts $productsBooker) {}

    #[Route('/products/{productId}/book', methods: ['POST'])]
    public function __invoke(string $productId, Request $request): JsonResponse
    {
        $quantity = $request->toArray()['quantity'];

        if ($quantity <= 0) {
            return new JsonResponse(null, Response::HTTP_BAD_REQUEST);
        }

        try {
            $this->productsBooker->bookProduct($productId, $quantity);

            return new JsonResponse(null, Response::HTTP_CREATED);
        } catch (InsufficientStock $e) {
            return new JsonResponse(null, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
