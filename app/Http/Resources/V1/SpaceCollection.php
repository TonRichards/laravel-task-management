<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class SpaceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     */
    public function toArray(Request $request): Collection
    {
        return $this->collection->transform(function ($item) {
            return [
                'id' => $item->uuid,
                'slug' => $item->slug,
                'name' => $item->name,
                'type' => $item->type->display_name,
            ];
        });
    }
}
