<?php

namespace App\Services\Checklist;

use App\Models\Checklist;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ChecklistService
{
    public function paginate(Request $request): LengthAwarePaginator
    {
        return Checklist::where('task_id', $request->get('task_id', 0))
            ->with(['task'])
            ->paginate($request->get('per_page', 10));
    }

    public function store(array $data): Checklist
    {
        return Checklist::create($data);
    }

    public function update(Checklist $checklist, array $data): Checklist
    {
        $checklist->update($data);

        return $checklist;
    }

    public function updateStatus(Checklist $checklist): Checklist
    {
        $checklist->update([
            'is_checked' => (bool) ! $checklist->is_checked,
        ]);

        return $checklist;
    }
}
