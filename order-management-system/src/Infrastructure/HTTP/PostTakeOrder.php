<?php
declare(strict_types=1);

namespace App\Infrastructure\HTTP;

use App\Domain\DriverPort\ITakeOrders;
use App\Domain\Exception\OrderFailed;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final readonly class PostTakeOrder
{
    public function __construct(private ITakeOrders $ordersTaker) {}

    #[Route(path: '/orders', name: 'take_orders', methods: ['POST'])]
    public function __invoke(Request $request): JsonResponse
    {
        $data = $request->toArray();

        try {
            $this->ordersTaker->take(
                $data['productId'],
                $data['quantity'],
                $data['unitPrice']
            );
        } catch (OrderFailed $e) {
            return new JsonResponse(['error' => 'Order failed'], 400);
        }

        return new JsonResponse(null, 201);
    }
}
