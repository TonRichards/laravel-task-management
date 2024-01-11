<?php

namespace App\Services\Space;

use App\Models\Space;
use Illuminate\Support\Str;

class SpaceCreateService
{
    public function store(array $data): Space
    {
        return Space::create([
            'uuid'      => Str::uuid(),
            'name'      => data_get($data, 'name'),
            'space_id'  => data_get($data, 'space_id'),
            'type_id'   => getSpaceTypeId($data['type']),
            'user_id'   => 1,
            'slug'      => data_get($data, 'slug')
        ]);
    }
}