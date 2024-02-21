<?php

namespace App\Services\Task;

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
}
