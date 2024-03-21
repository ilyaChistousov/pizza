<?php

namespace App\Services\User;

use App\DTO\Order\OrderDTO;
use App\DTO\User\GetUserDTO;
use App\Models\Order;
use App\Models\User;

class UserService
{
    public function index(): array
    {
        $users = User::query()->with('orders')->get();

        $mapped = $users->map(function (User $user) {
            $user->ordersInfo = $user->orders
                ->map(fn(Order $order) => OrderDTO::from($order))
                ->toArray();

            return GetUserDTO::from($user);
        });

        return $mapped->toArray();
    }

    public function show(User $user): array
    {
        $orders = Order::where('user_id', $user->id)->get();
        $data['orders'] = $orders
            ->map(fn (Order $order) => OrderDTO::from($order)->toArray())
            ->toArray();

        return GetUserDTO::from($user, $data)->toArray();
    }
}
