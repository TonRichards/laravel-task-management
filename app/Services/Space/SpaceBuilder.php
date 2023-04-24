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

    public function findByUuid($uuid): Space
    {
        return $this->model()->where('uuid', $uuid)->firstOrFail();
    }

    public function store(array $data): Space
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

    public function updateSpace(string $uuid, array $data): Space
    {
        $space = $this->findByUuid($uuid);

        $space->update([
            'name' => $data['name'],
            'slug' => $data['slug']
        ]);

        return $space;
    }

    public function deleteSpace(string $uuid): void
    {
        $space = $this->findByUuid($uuid);

        $space->delete();
    }
}
