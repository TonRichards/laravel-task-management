<?php

namespace App\Services\Checklist;

use App\Models\Checklist;

class ChecklistUpdateService
{
    public function update(Checklist $checklist, array $data): Checklist
    {
        $checklist->update($data);

        return $checklist;
    }

    public function updateStatus(Checklist $checklist): Checklist
    {
        $this->update($checklist, ['is_checked' => (bool) ! $checklist->is_checked]);

        return $checklist->fresh();
    }
}
