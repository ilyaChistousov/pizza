<?php

namespace App\Services\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function register(RegisterRequest $request): void
    {
        $user = User::create($request->dto()->toArray());

        $orders = Order::where('phone', $user->phone)->get();

        foreach ($orders as $order) {
            $user->orders()->save($order);
        }

        event(new Registered($user));

        Auth::login($user);
    }
}
