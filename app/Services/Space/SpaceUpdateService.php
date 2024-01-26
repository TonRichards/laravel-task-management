<?php

namespace App\Services\Space;

use App\Models\Space;

class SpaceUpdateService
{
    public function update(Space $space, array $data): Space
    {
        return $space->update([
            'name' => $data['name'],
            'slug' => $data['slug']
        ]);
    }
}