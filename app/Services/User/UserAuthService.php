<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserAuthService
{
    public function register(array $data): void
    {
        User::create((new UserDtoService($data))->make());
    }

    public function checkUserLogin(string $email, string $password): User|null
    {
        $user = User::firstWhere('email', $email);

        if (! $user) {
            return null;
        }

        $check = Hash::check($password, $user->password);

        if (! $check) {
            return null;
        }

        return $user;
    }
}
