<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Requests\Order\UpdateStatusRequest;
use App\Models\Order;
use App\Services\Order\OrderService;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{

    public function __construct(
        public OrderService $service)
    {}

    public function index()
    {
        $this->authorize('viewAny', Order::class);

        $orders = $this->service->index();

        return responseWithResource($orders);
    }

    public function store(StoreOrderRequest $request): JsonResponse
    {
        $this->service->store($request->dto());

        return responseOk();
    }

    public function updateStatus(UpdateStatusRequest $request, Order $order)
    {
        $this->authorize('update', $order);
        $order->status = $request->status;
        $order->save();
        return responseOk();
    }

    public function destroy(Order $order)
    {
        $this->authorize('delete', $order);
        $order->delete();

        return responseOk();

    }
}
