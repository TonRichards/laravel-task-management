<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    public function paginate(Request $request): LengthAwarePaginator
    {
        return User::paginate($request->get('per_page', 10));
    }

    public function update(User $user, Array $data): User
    {
        return $user->update([
            'name' => $data['name'],
            'email' => $data['email']
        ]);
    }
}