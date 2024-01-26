<?php

namespace App\Services\Space;

use App\Models\Space;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class SpaceService
{
    public function paginate(Request $request): LengthAwarePaginator
    {
        return Space::paginate($request->get('per_page', 10));
    }
}
