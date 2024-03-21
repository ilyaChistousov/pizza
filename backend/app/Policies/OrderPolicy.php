<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\User;
use App\Models\Order;
use Illuminate\Auth\Access\Response;

class OrderPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === UserRole::ADMIN;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Order $model): bool
    {
        return $user->role === UserRole::ADMIN || $user->id === $model->user_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Order $model): bool
    {
        return $user->role === UserRole::ADMIN;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Order $model): bool
    {
        return $user->role === UserRole::ADMIN;
    }
}
