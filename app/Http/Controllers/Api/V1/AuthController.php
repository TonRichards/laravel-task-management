<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\User\UserLoginRequest;
use App\Http\Requests\V1\User\UserRegisterRequest;
use App\Services\User\UserAuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(protected UserAuthService $authService)
    {
    }

    public function register(UserRegisterRequest $request): JsonResponse
    {
        $this->authService->register($request->validated());

        return response()->created();
    }

    public function login(UserLoginRequest $request): JsonResponse
    {
        $user = $this->authService->checkUserLogin($request->email, $request->password);

        if (! $user) {
            return response()->unauthorized();
        }

        return response()->success([
            'name' => $user->name,
            'email' => $user->email,
            'token' => $user->createToken('LaravelTaskManagementToken')->accessToken,
        ]);
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
