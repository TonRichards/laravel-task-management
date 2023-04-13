<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Services\User\UserBuilder;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\User\UserRegisterRequest;

class AccountController extends Controller
{
    protected UserBuilder $userBuilder;

    public function __construct(UserBuilder $userBuilder)
    {
        $this->userBuilder = $userBuilder;
    }

    public function register(UserRegisterRequest $request): JsonResponse
    {
        $data = $request->validated();

        $this->userBuilder->register($data);

        return response()->created();
    }
}
