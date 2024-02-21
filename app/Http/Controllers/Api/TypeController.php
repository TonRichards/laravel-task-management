<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TypeCollection;
use App\Services\Type\TypeBuilder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    protected TypeBuilder $typeBuilder;

    public function __construct(TypeBuilder $typeBuilder)
    {
        $this->typeBuilder = $typeBuilder;
    }

    public function index(Request $request): JsonResponse
    {
        $scope = $request->get('scope');

        $types = $this->typeBuilder->getTypeList($scope);

        return response()->success(new TypeCollection($types));
    }
}
