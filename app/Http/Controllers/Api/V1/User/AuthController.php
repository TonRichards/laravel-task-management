<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\User\UserBuilder;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserLoginRequest;
use App\Http\Requests\User\UserRegisterRequest;

class AuthController extends Controller
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

    public function login(UserLoginRequest $request): JsonResponse
    {
        $user = $this->userBuilder->checkUserLogin($request->email, $request->password);

        if (!$user) {
            return response()->unauthorized();
        }

        $data = [
            'name'  => $user->name,
            'email' => $user->email,
            'token' => $user->createToken('LaravelTaskManagementToken')->accessToken,
        ];

        return response()->success($data);
    }

    public function logout(Request $request): JsonResponse
    {
        $user = auth()->user()->token();

        $user->revoke();

        return response()->success();
    }

    public function current(Request $request): JsonResponse
    {
        $user = auth()->user();

        return response()->success([
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }
}
