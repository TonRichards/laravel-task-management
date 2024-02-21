<?php

use App\Models\Type;

if (! function_exists('getSpaceTypeId')) {
    function getSpaceTypeId(string $name)
    {
        $type = Type::where('name', $name)->where('scope', 'space')->first();

        if (is_null($type)) {
            return null;
        }

        return $type->id;
    }
}
