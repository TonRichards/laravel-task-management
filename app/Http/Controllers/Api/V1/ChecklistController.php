<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Checklist\ChecklistStoreRequest;
use App\Services\Checklist\ChecklistCreateService;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    public function store(ChecklistStoreRequest $request, ChecklistCreateService $createService)
    {
        $data = $createService->create($request->validated());

        $checklist = [
            'name' => $data->name,
            'task_id' => $data->task_id,
        ];

        dd($checklist);
    }
}
