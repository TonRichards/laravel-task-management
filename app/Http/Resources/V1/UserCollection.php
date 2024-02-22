<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class UserCollection extends ResourceCollection
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
                'email' => $item->email,
            ];
        });
    }
}
