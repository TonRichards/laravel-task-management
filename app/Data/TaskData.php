<?php

namespace App\Data;

use App\Enums\Status;
use App\Models\Task;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class TaskData
{
    public function __construct(protected array $params)
    {
    }

    public function make(Task $task = null): array
    {
        $data = [
            'name' => Arr::get($this->params, 'name'),
            'type' => Arr::get($this->params, 'type'),
            'user_id' => auth()->user()->id,
        ];

        if (! $task) {
            $data['uuid'] = Str::uuid();
            $data['status'] = Status::TO_DO->value;
        }

        if ($body = Arr::get($this->params, 'body')) {
            $data['body'] = $body;
        }

        if ($status = Arr::get($this->params, 'status')) {
            $data['status'] = $status;
        }

        if ($taskId = Arr::get($this->params, 'task_id')) {
            $data['task_id'] = $taskId;
        }

        if ($spaceId = Arr::get($this->params, 'space_id')) {
            $data['space_id'] = $spaceId;
        }

        return $data;
    }
}
