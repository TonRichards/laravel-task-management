<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\User\UserLoginRequest;
use App\Http\Requests\V1\User\UserRegisterRequest;
use App\Services\User\UserLoginService;
use App\Services\User\UserRegisterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected UserRegisterService $registerService;

    protected UserLoginService $loginService;

    public function __construct(UserRegisterService $registerService, UserLoginService $loginService)
    {
        $this->registerService = $registerService;

        $this->loginService = $loginService;
    }

    public function register(UserRegisterRequest $request): JsonResponse
    {
        $this->registerService->register($request->validated());

        return response()->created();
    }

    public function login(UserLoginRequest $request): JsonResponse
    {
        $user = $this->loginService->checkUserLogin($request->email, $request->password);

        if (! $user) {
            return response()->unauthorized();
        }

        $data = [
            'name' => $user->name,
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
