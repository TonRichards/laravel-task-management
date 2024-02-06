<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\controller;
use App\Http\Resources\V1\TaskResource;
use App\Services\Task\TaskCreateService;
use App\Http\Requests\V1\Task\TaskStoreRequest;

class TaskController extends Controller
{
    public function store(TaskStoreRequest $request, TaskCreateService $service): JsonResponse
    {
        $task = $service->store($request->validated());

        return response()->success(new TaskResource($task));
    }
}
