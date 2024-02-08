<?php

namespace App\Services\Task;

use App\Models\Task;
use Illuminate\Support\Arr;

class TaskUpdateService
{
    public function update(Task $task, array $data): Task
    {
        $task->update([
            'name' => Arr::get($data, 'name'),
            'body' => Arr::get($data, 'body'),
            'type_id' => Arr::get($data, 'type_id'),
            'task_id' => Arr::get($data, 'task_id')
        ]);

        return $task;
    }

    public function updateStatus(Task $task, array $data): Task
    {
        $task->update(['status_id' => $data['status_id']]);

        return $task;
    }
}