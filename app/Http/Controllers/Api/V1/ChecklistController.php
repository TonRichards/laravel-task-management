<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Checklist\ChecklistStoreRequest;
use App\Http\Requests\V1\Checklist\ChecklistUpdateRequest;
use App\Http\Resources\V1\ChecklistCollection;
use App\Http\Resources\V1\ChecklistResource;
use App\Models\Checklist;
use App\Services\Checklist\ChecklistCreateService;
use App\Services\Checklist\CheckListService;
use App\Services\Checklist\ChecklistUpdateService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    protected ChecklistService $service;

    public function __construct(CheckListService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request): JsonResponse
    {
        $data = $this->service->paginate($request);

        return response()->success(new ChecklistCollection($data));
    }

    public function store(ChecklistStoreRequest $request, ChecklistCreateService $createService): JsonResponse
    {
        $data = $createService->create($request->validated());

        return response()->success(new ChecklistResource($data));
    }

    public function update(Checklist $checklist, ChecklistUpdateRequest $request, ChecklistUpdateService $updateService): JsonResponse
    {
        $data = $updateService->update($checklist, $request->validated());

        return response()->success(new ChecklistResource($data));
    }

    public function updateStatus(Checklist $checklist, ChecklistUpdateService $updateService): JsonResponse
    {
        $data = $updateService->updateStatus($checklist);

        return response()->success(new ChecklistResource($data));
    }

    public function destroy(Checklist $checklist): JsonResponse
    {
        $checklist->delete();

        return response()->success();
    }
}
