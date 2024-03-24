<?php

namespace App\Services\Order;

use App\DTO\Order\DetailedOrderDTO;
use App\DTO\Order\NewOrderDTO;
use App\DTO\Product\PivotProductDTO;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class OrderService
{
    public function index()
    {
        $orders = Order::query()->with('products')->get();

        $mapped = $orders->map(function (Order $order) {
            $order->orderProducts = $order->products->map(function (Product $product) {
                $product->price = $product->pivot->price;
                $product->size = $product->pivot->size;
                $product->quantity = $product->pivot->quantity;

                return PivotProductDTO::from($product)->toArray();
            })->toArray();

            return DetailedOrderDTO::from($order);
        });

        return $mapped->toArray();
    }

    public function store(NewOrderDTO $dto)
    {
        $data = $dto->except('products')->toArray();
        $newOrder = Order::query()->create($data);

        foreach ($dto->products as $product) {
            $newOrder->products()->attach($product['id'], [
                'quantity' => $product['quantity'],
                'size' => $product['size'],
                'price' => $product['price'],
            ]);
        }

        $user = User::query()->where('phone', $dto->phone)->first();
        if ($user) {
            $newOrder->user_id = $user->id;
            $newOrder->save();
        }
    }
}
