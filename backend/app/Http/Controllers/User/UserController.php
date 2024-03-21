<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{

    public function __construct(
        public UserService $service
    )
    {}

    public function index(): JsonResponse
    {
        $this->authorize('viewAny', User::class);

        $users = $this->service->index();

        return responseWithResource($users);
    }

    public function show(User $user): JsonResponse
    {
        $this->authorize('view', $user);

        $user = $this->service->show($user);

        return responseWithResource($user);
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
