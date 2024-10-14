<?php

namespace App\Services;

use App\Data\SpaceData;
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
            ->where('type', SpaceType::PROJECT->value)
            ->with(['user', 'subSpaces'])
            ->paginate($request->get('per_page', 20));
    }

    public function store(SpaceStoreRequest $request): Space
    {
        return $this->model()->create((new SpaceData($request->validated()))->make());
    }

    public function update(Space $space, SpaceUpdateRequest $request): Space
    {
        $space->update((new SpaceData($request->validated()))->make($space));

        return $space;
    }

    public function favorited(Space $space): void
    {
        $space->update([
            'is_favorited' => ! $space->is_favorited,
        ]);
    }

    public function getSubSpaces(Request $request, Space $space): LengthAwarePaginator
    {
        return $space->subSpaces()
            ->where('type', SpaceType::FOLDER->value)
            ->paginate($request->get('per_page', 20));
    }
}
