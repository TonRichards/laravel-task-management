<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\User\UserBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Http\Requests\User\UserUpdateRequest;

class UserController extends Controller
{
    protected UserBuilder $userBuilder;

    public function __construct(UserBuilder $userBuilder)
    {
        $this->userBuilder = $userBuilder;
    }

    public function update(UserUpdateRequest $request, string $uuid): JsonResponse
    {
        $data = $request->validated();

        $user = $this->userBuilder->updateProfile($uuid, $data);

        return response()->success(new UserResource($user));
    }
}
