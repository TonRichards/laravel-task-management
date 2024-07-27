<?php

namespace App\Http\Controllers\Api;

use App\Enums\Scope;
use App\Http\Controllers\Controller;
use App\Http\Resources\Menus\SpaceCollection;
use App\Services\Menu\MenuService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __construct(protected MenuService $menuService)
    {
    }

    public function getMenus(Request $request): JsonResponse
    {
        switch ($scope = $request->get('scope')) {
            case Scope::SPACE->value :
                return response()->success(new SpaceCollection($this->menuService->getSpaceMenus()));

            default:
                return response()->success();
        }
    }
}
