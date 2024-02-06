<?php

namespace App\Services\Task;

use App\Models\Task;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class TaskCreateService
{
    public function store(array $data): Task
    {
        return Task::create([
            'uuid' => Str::uuid(),
            'name' => Arr::get($data, 'name'),
            'body' => Arr::get($data, 'body'),
            'space_id' => Arr::get($data, 'space_id'),
            'type_id' => Arr::get($data, 'type_id'),
            'user_id' => 1, // need to update later
            'status_id' => Arr::get($data, 'status_id', 1)
        ]);
    }
}