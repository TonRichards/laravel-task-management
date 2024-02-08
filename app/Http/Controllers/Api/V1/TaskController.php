<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\controller;
use App\Http\Requests\V1\Task\TaskUpdateRequest;
use App\Http\Requests\V1\Task\TaskStoreRequest;
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
    public function __construct(protected TaskService $service)
    {
        $this->service = $service;
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

    public function update(Task $task, TaskUpdateRequest $request, TaskUpdateService $service): JsonResponse
    {
        $data = $service->update($task, $request->validated());

        return response()->success(new TaskResource($data));
    }
}
