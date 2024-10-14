<?php

namespace App\Services;

use App\Data\TaskData;
use App\Http\Requests\V1\Task\TaskStoreRequest;
use App\Http\Requests\V1\Task\TaskUpdateRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class TaskService
{
    public function paginate(Request $request): Collection
    {
        $tasks = Task::where('space_id', $request->get('space_id', 0));

        if ($statusId = $request->get('status_id')) {
            $tasks = $tasks->where('status_id', $statusId);
        }

        $tasks->with(['subTasks']);

        return $tasks->get();
    }

    public function store(TaskStoreRequest $request): Task
    {
        return Task::create((new TaskData($request->validated()))->make());
    }

    public function update(Task $task, TaskUpdateRequest $request): Task
    {
        $task->update((new TaskData($request->validated()))->make($task));

        return $task;
    }

    public function updateStatus(Task $task, string $status): Task
    {
        $task->update(['status' => $status]);

        return $task;
    }
}
