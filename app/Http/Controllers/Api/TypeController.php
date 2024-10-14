<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TypeCollection;
use App\Services\TypeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    protected TypeService $typeService;

    public function __construct(TypeService $typeService)
    {
        $this->typeService = $typeService;
    }

    public function index(Request $request): JsonResponse
    {
        $scope = $request->get('scope');

        $types = $this->typeService->getTypeList($scope);

        return response()->success(new TypeCollection($types));
    }
}
