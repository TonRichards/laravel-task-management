<?php

namespace App\Services\Space;

use App\Models\Space;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class SpaceCreateService
{
    public function store(array $data): Space
    {
        return Space::create([
            'uuid'      => Str::uuid(),
            'name'      => Arr::get($data, 'name'),
            'space_id'  => Arr::get($data, 'space_id'),
            'type_id'   => Arr::get($data, 'type_id'),
            'user_id'   => 1, // need to update later
            'slug'      => Arr::get($data, 'slug')
        ]);
    }
}