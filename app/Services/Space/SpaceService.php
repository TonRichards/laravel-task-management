<?php

namespace App\Services\Space;

use App\Http\Requests\V1\Space\SpaceStoreRequest;
use App\Http\Requests\V1\Space\SpaceUpdateRequest;
use App\Models\Space;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class SpaceService
{
    public function paginate(Request $request): LengthAwarePaginator
    {
        return Space::with('type')->paginate($request->get('per_page', 10));
    }

    public function store(SpaceStoreRequest $request): Space
    {
        return Space::create((new SpaceDtoService($request->validated()))->make());
    }

    public function update(Space $space, SpaceUpdateRequest $request): Space
    {
        $space->update((new SpaceDtoService($request->validated()))->make($space));

        return $space;
    }
}
