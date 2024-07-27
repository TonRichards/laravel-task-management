<?php

namespace App\Services\Space;

use App\Enums\SpaceType;
use App\Http\Requests\V1\Space\SpaceStoreRequest;
use App\Http\Requests\V1\Space\SpaceUpdateRequest;
use App\Models\Space;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class SpaceService
{
    public function model(): Space
    {
        return new Space();
    }

    public function paginate(Request $request): LengthAwarePaginator
    {
        return $this->model()
            ->where('type_id', getSpaceTypeId(SpaceType::MAIN_SPACE->value))
            ->with(['user', 'type', 'subSpaces'])
            ->paginate($request->get('per_page', 20));
    }

    public function store(SpaceStoreRequest $request): Space
    {
        return $this->model()->create((new SpaceDataService($request->validated()))->make());
    }

    public function update(Space $space, SpaceUpdateRequest $request): Space
    {
        $space->update((new SpaceDataService($request->validated()))->make($space));

        return $space;
    }
}
