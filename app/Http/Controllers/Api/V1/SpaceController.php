<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Space\SpaceStoreRequest;
use App\Http\Requests\V1\Space\SpaceUpdateRequest;
use App\Http\Resources\V1\Spaces\SpaceCollection;
use App\Http\Resources\V1\Spaces\SpaceResource;
use App\Models\Space;
use App\Services\Space\SpaceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SpaceController extends Controller
{
    public function __construct(protected SpaceService $spaceService)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $spaces = $this->spaceService->paginate($request);

        return response()->success(new SpaceCollection($spaces));
    }

    public function store(SpaceStoreRequest $request): JsonResponse
    {
        $space = $this->spaceService->store($request);

        return response()->success(new SpaceResource($space));
    }

    public function show(Space $space): JsonResponse
    {
        return response()->success(new SpaceResource($space));
    }

    public function update(Space $space, SpaceUpdateRequest $request): JsonResponse
    {
        $space = $this->spaceService->update($space, $request);

        return response()->success(new SpaceResource($space));
    }

    public function destroy(Space $space): JsonResponse
    {
        $space->delete();

        return response()->success();
    }
}
