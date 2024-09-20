<?php

namespace App\Data;

use App\Models\Space;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class SpaceData
{
    public function __construct(protected array $params)
    {
    }

    public function make(Space $space = null): array
    {
        $data = [
            'name' => Arr::get($this->params, 'name'),
            'user_id' => auth()->user()->uuid,
        ];

        if (! $space) {
            $data['uuid'] = Str::uuid();
        }

        if ($spaceId = Arr::get($this->params, 'space_id')) {
            $data['space_id'] = $spaceId;
        }

        if ($type = Arr::get($this->params, 'type')) {
            $data['type'] = $type;
        }

        if (! $statuses = Arr::get($this->params, 'statuses')) {
            $data['statuses'] = config('settings.default-status');
        }

        return $data;
    }
}
