<?php

namespace App\Services\Space;

use App\Models\Type;
use App\Models\Space;
use Illuminate\Database\Eloquent\Collection;

class SpaceService
{
    public function model(): Space
    {
        return new Space();
    }

    public function findByUuid($uuid): Space
    {
        return $this->model()->where('uuid', $uuid)->firstOrFail();
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
