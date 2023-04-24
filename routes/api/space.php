<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Space\SpaceController;

/*
|--------------------------------------------------------------------------
| Space API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(SpaceController::class)->group(function () {
    Route::post('/', 'store');
    Route::put('/{uuid}', 'update');
    Route::delete('/{uuid}', 'destroy');
});
