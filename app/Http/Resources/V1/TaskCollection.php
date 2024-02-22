<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class TaskCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     */
    public function toArray(Request $request): Collection
    {
        return $this->collection->transform(function ($item) {
            return [
                'uuid' => $item->uuid,
                'name' => $item->name,
                'body' => $item->body,
                'space' => $item->space->name,
                'type' => $item->type->display_name,
                'sub_tasks' => new SubTaskCollection($item->subTasks),
            ];
        });
    }
}
