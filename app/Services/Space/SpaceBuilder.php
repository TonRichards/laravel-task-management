<?php

namespace App\Services\Space;

use App\Models\Type;
use App\Models\Space;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;

class SpaceBuilder
{
    public function model(): Space
    {
        return new Space();
    }

    public function store(Array $data): Space
    {
        $space = $this->model()->create([
            'uuid'      => Str::uuid(),
            'name'      => data_get($data, 'name'),
            'space_id'  => data_get($data, 'space_id'),
            'type_id'   => getSpaceTypeId($data['type']),
            'user_id'   => auth()->user()->id,
            'slug'      => data_get($data, 'slug')
        ]);

        return $space;
    }
}
