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

    public function findByUuid($uuid): User
    {
        return $this->model()->firstWhere('uuid', $uuid);
    }

    public function register(Array $data): void
    {
        $this->model()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}