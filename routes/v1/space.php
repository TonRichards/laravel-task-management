<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Space\SpaceController;

Route::controller(SpaceController::class)->group(function () {
    Route::post('/', 'store');
    Route::put('/{uuid}', 'update');
    Route::delete('/{uuid}', 'destroy');
});
