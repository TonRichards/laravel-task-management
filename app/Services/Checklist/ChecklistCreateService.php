<?php

namespace App\Services\Checklist;

use App\Models\Checklist;

class ChecklistCreateService
{
    public function create(array $data): Checklist
    {
        return Checklist::create($data);
    }
}
