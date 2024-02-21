<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\controller;
use App\Http\Requests\V1\Task\TaskStoreRequest;
use App\Http\Requests\V1\Task\TaskUpdateRequest;
use App\Http\Requests\V1\Task\TaskUpdateStatusRequest;
use App\Http\Resources\V1\TaskCollection;
use App\Http\Resources\V1\TaskResource;
use App\Models\Task;
use App\Services\Task\TaskCreateService;
use App\Services\Task\TaskService;
use App\Services\Task\TaskUpdateService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected TaskService $service;

    protected TaskUpdateService $updateService;

    public function __construct(TaskService $service, TaskUpdateService $updateService)
    {
        $this->service = $service;

        $this->updateService = $updateService;
    }

    public function index(Request $request)
    {
        $tasks = $this->service->paginate($request);

        return response()->success(new TaskCollection($tasks));
    }

    public function store(TaskStoreRequest $request, TaskCreateService $service): JsonResponse
    {
        $task = $service->store($request->validated());

        return response()->success(new TaskResource($task));
    }

    public function show(Task $task)
    {
        return response()->success(new TaskResource($task));
    }

    public function update(Task $task, TaskUpdateRequest $request): JsonResponse
    {
        $data = $this->updateService->update($task, $request->validated());

        return response()->success(new TaskResource($data));
    }

    public function updateStatus(Task $task, TaskUpdateStatusRequest $request)
    {
        $data = $this->updateService->updateStatus($task, $request->validated());

        return response()->success(new TaskResource($data));
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return response()->success();
    }
}
