<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Support\collection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ChecklistCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     */
    public function toArray(Request $request): collection
    {
        return $this->collection->transform(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'task' => $item->task->name,
                'is_checked' => (bool) $item->is_checked,
            ];
        });
    }
}
