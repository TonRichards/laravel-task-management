<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserDtoService
{
    public function __construct(protected array $params)
    {
    }

    public function make(User $user = null): array
    {
        $data = [
            'name' => Arr::get($this->params, 'name'),
            'email' => Arr::get($this->params, 'email'),
        ];

        if ($password = Arr::get($this->params, 'password')) {
            $data['password'] = Hash::make($password);
        }

        if (! $user) {
            $data['uuid'] = Str::uuid();
        }

        return $data;
    }
}
