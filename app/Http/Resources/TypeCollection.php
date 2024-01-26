<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\collection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TypeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): Collection
    {
        return $this->collection->transform(function ($item) {
            return [
                'id' => $item->id,
                'display_name' => $item->display_name
            ];
        });
    }
}