<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\Type\TypeBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\Type\TypeCollection;

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
