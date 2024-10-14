<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Task\TaskStoreRequest;
use App\Http\Requests\V1\Task\TaskUpdateRequest;
use App\Http\Requests\V1\Task\TaskUpdateStatusRequest;
use App\Http\Resources\V1\TaskCollection;
use App\Http\Resources\V1\TaskResource;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(protected TaskService $taskService)
    {
    }

    public function index(Request $request)
    {
        $tasks = $this->taskService->paginate($request);

        return response()->success(new TaskCollection($tasks));
    }

    public function store(TaskStoreRequest $request): JsonResponse
    {
        $task = $this->taskService->store($request);

        return response()->success(new TaskResource($task));
    }

    public function show(Task $task)
    {
        return response()->success(new TaskResource($task));
    }

    public function update(Task $task, TaskUpdateRequest $request): JsonResponse
    {
        $task = $this->taskService->update($task, $request);

        return response()->success(new TaskResource($task));
    }

    public function updateStatus(Task $task, TaskUpdateStatusRequest $request)
    {
        $data = $this->taskService->updateStatus($task, $request->get('status'));

        return response()->success(new TaskResource($data));
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return response()->success();
    }
}
