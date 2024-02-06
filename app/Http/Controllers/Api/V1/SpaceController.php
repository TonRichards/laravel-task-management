<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Space;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\Space\SpaceService;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\SpaceCollection;
use App\Http\Resources\V1\SpaceResource;
use App\Services\Space\SpaceCreateService;
use App\Http\Requests\Space\V1\SpaceStoreRequest;
use App\Http\Requests\Space\V1\SpaceUpdateRequest;

class SpaceController extends Controller
{
    protected SpaceService $spaceService;

    public function __construct(SpaceService $spaceService)
    {
        $this->spaceService = $spaceService;
    }

    public function index(Request $request): JsonResponse
    {
        $spaces = $this->spaceService->paginate($request);

        return response()->success(new SpaceCollection($spaces));
    }

    public function store(SpaceStoreRequest $request, SpaceCreateService $service): JsonResponse
    {
        $space = $service->store($request->validated());

        return response()->success(new SpaceResource($space));
    }

    public function show(Space $space): JsonResponse
    {
        return response()->success(new SpaceResource($space));
    }

    public function update(Space $space, SpaceUpdateRequest $request, SpaceUpdateService $service): JsonResponse
    {
        $data = $request->validated();

        $space = $this->service->update($space, $data);

        return response()->success(new SpaceResource($space));
    }

    public function destroy(Space $space): JsonResponse
    {
        $space->delete();

        return response()->success();
    }
}
