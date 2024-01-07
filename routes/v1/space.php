<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Space\SpaceController;

Route::controller(SpaceController::class)->group(function () {
    Route::post('/spaces', 'store');
    Route::put('/spaces/{space}', 'update');
    Route::delete('/spaces/{space}', 'destroy');
});
