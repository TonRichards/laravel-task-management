<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Checklist\ChecklistStoreRequest;
use App\Http\Resources\V1\ChecklistCollection;
use App\Http\Resources\V1\ChecklistResource;
use App\Services\Checklist\CheckListService;
use App\Services\Checklist\ChecklistCreateService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

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
}
