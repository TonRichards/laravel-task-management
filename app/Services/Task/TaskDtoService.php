<?php

namespace App\Services\Task;

use App\Models\Status;
use App\Models\Task;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class TaskDtoService
{
    public function __construct(protected array $params)
    {
    }

    public function make(Task $task = null): array
    {
        $data = [
            'name' => Arr::get($this->params, 'name'),
            'type_id' => Arr::get($this->params, 'type_id'),
            'user_id' => auth()->user()->id,
        ];

        if (! $task) {
            $data['uuid'] = Str::uuid();
            $data['status_id'] = Status::getStatusId(Status::TODO);
        }

        if ($body = Arr::get($this->params, 'body')) {
            $data['body'] = $body;
        }

        if ($statusId = Arr::get($this->params, 'status_id')) {
            $data['status_id'] = $statusId;
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
