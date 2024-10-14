<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Checklist\ChecklistStoreRequest;
use App\Http\Requests\V1\Checklist\ChecklistUpdateRequest;
use App\Http\Resources\V1\ChecklistCollection;
use App\Http\Resources\V1\ChecklistResource;
use App\Models\Checklist;
use App\Services\ChecklistService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    public function __construct(protected ChecklistService $checklistService)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $data = $this->checklistService->paginate($request);

        return response()->success(new ChecklistCollection($data));
    }

    public function store(ChecklistStoreRequest $request): JsonResponse
    {
        $data = $this->checklistService->store($request->validated());

        return response()->success(new ChecklistResource($data));
    }

    public function update(Checklist $checklist, ChecklistUpdateRequest $request): JsonResponse
    {
        $data = $this->checklistService->update($checklist, $request->validated());

        return response()->success(new ChecklistResource($data));
    }

    public function updateStatus(Checklist $checklist): JsonResponse
    {
        $data = $this->checklistService->updateStatus($checklist);

        return response()->success(new ChecklistResource($data));
    }

    public function destroy(Checklist $checklist): JsonResponse
    {
        $checklist->delete();

        return response()->success();
    }
}
