<?php

namespace App\Services;

use App\Enums\SpaceType;
use App\Models\Space;
use Illuminate\Database\Eloquent\Collection;

class MenuService
{
    public function model(): Space
    {
        return new Space();
    }

    public function getSpaceMenus(): Collection
    {
        return $this->model()
            ->where('type', SpaceType::PROJECT->value)
            ->where('user_id', auth()->user()->uuid)
            ->get();
    }

    public function getFavoritedSpaces(): Collection
    {
        return $this->model()
            ->where('user_id', auth()->user()->uuid)
            ->where('is_favorited', true)
            ->get();
    }
}
