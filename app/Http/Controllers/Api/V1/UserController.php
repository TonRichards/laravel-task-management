<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\V1\UserCollection;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(protected UserService $userService)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $users = $this->userService->paginate($request);

        return response()->success(new UserCollection($users));
    }

    public function show(User $user): JsonResponse
    {
        return response()->success(new UserResource($user));
    }

    public function update(UserUpdateRequest $request, User $user): JsonResponse
    {
        $user = $this->userService->update($user, $request->validated());

        return response()->success(new UserResource($user));
    }
}
