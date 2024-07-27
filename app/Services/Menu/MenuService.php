<?php

namespace App\Services\Menu;

use App\Enums\SpaceType;
use App\Models\Space;
use Illuminate\Database\Eloquent\Collection;

class MenuService
{
    public function spaceModel(): Space
    {
        return new Space();
    }

    public function getSpaceMenus(): Collection
    {
        return $this->spaceModel()
            ->where('type_id', getSpaceTypeId(SpaceType::MAIN_SPACE->value))
            ->where('user_id', auth()->user()->id)
            ->get();
    }
}
