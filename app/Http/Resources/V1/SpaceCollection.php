<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Support\collection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SpaceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): collection
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
