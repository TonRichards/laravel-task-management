<?php

namespace App\Http\Controllers\Api\Space;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\Space\SpaceBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\Space\SpaceResource;
use App\Http\Requests\Space\SpaceStoreRequest;

class SpaceController extends Controller
{
    protected SpaceBuilder $spaceBuilder;

    public function __construct(SpaceBuilder $spaceBuilder)
    {
        $this->spaceBuilder = $spaceBuilder;
    }

    public function store(SpaceStoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        $space = $this->spaceBuilder->store($data);

        return response()->success(new SpaceResource($space));
    }
}
