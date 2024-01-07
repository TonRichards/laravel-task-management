<?php

namespace App\Http\Controllers\Api\V1\Space;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\Space\SpaceService;
use App\Http\Controllers\Controller;
use App\Http\Resources\SpaceResource;
use App\Http\Requests\Space\SpaceStoreRequest;
use App\Http\Requests\Space\SpaceUpdateRequest;

class SpaceController extends Controller
{
    protected SpaceService $spaceService;

    public function __construct(SpaceService $spaceService)
    {
        $this->spaceService = $spaceService;
    }

    public function store(SpaceStoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        $space = $this->spaceService->store($data);

        return response()->success(new SpaceResource($space));
    }

    public function update(SpaceUpdateRequest $request, $uuid): JsonResponse
    {
        $data = $request->validated();

        $space = $this->spaceService->updateSpace($uuid, $data);

        return response()->success(new SpaceResource($space));
    }

    public function destroy($uuid): JsonResponse
    {
        $this->spaceService->deleteSpace($uuid);

        return response()->success();
    }
}
