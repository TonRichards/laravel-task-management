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

        if (! $user || $user->isBlocked()) {
            return null;
        }

        $numberOfAttemp = $user->number_of_attemp;

        if ($numberOfAttemp >= User::LOGIN_ATTEMP_LIMITATION) {

            $user->update([
                'number_of_attemp' => 0,
                'block_until' => now()->addMinutes(10)->toDateTimeString(),
            ]);

            return null;
        }

        $user->update(['number_of_attemp' => $numberOfAttemp + 1]);

        $check = Hash::check($password, $user->password);

        if (! $check) {
            return null;
        }

        $user->update(['number_of_attemp' => 0]);

        return $user;
    }
}
