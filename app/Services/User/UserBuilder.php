<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserBuilder
{
    public function model(): User
    {
        return new User();
    }

    public function findByUuid(string $uuid): User
    {
        return $this->model()->firstWhere('uuid', $uuid);
    }

    public function findByEmail(string $email): User|null
    {
        return $this->model()->firstWhere('email', $email);
    }

    public function register(Array $data): void
    {
        $this->model()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function checkUserLogin(string $email, string $password): User|null
    {
        $user = $this->findByEmail($email);

        if (!$user) {
            return null;
        }

        $check = Hash::check($password, $user->password);

        if (!$check) {
            return null;
        }

        return $user;
    }
}