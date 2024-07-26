<?php

namespace App\Services\Type;

use App\Models\Type;
use Illuminate\Database\Eloquent\Collection;

class TypeService
{
    public function model(): Type
    {
        return new Type();
    }

    public function getTypeList(string $scope = null): Collection
    {
        $types = $this->model();

        if ($scope) {
            $types = $types->where('scope', $scope);
        }

        return $types->get();
    }
}
