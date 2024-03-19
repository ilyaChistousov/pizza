<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{

    public function index(): JsonResponse
    {
        $this->authorize('viewAny', User::class);

        $users = User::all();

        return responseWithResource($users->toArray());
    }

    public function show(User $user): JsonResponse
    {
        $this->authorize('view', $user);

        return responseWithResource($user->toArray());
    }

    public function update(UserUpdateRequest $request, User $user): JsonResponse
    {
        $this->authorize('update', $user);

        $user->update($request->validated());

        return responseOk();
    }

    public function destroy(User $user): JsonResponse
    {
        $this->authorize('delete', $user);

        $user->delete();

        return responseOk();
    }
}
