<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\SpaceController;
use App\Http\Controllers\Api\V1\TaskController;

Route::controller(AuthController::class)->group(function () {
    Route::post('users/register', 'register');
    Route::post('users/login', 'login');
    Route::post('users/logout', 'logout')->middleware('auth:api');
    Route::get('users/current', 'current')->middleware('auth:api');
});

Route::controller(UserController::class)->middleware('auth:api')->group(function () {
    Route::get('users', 'index');
    Route::get('users/{user}', 'show');
});

Route::controller(SpaceController::class)->group(function () {
    Route::get('/spaces', 'index');
    Route::post('/spaces', 'store');
    Route::get('spaces/{space}', 'show');
    Route::put('/spaces/{space}', 'update');
    Route::delete('/spaces/{space}', 'destroy');
});

Route::controller(TaskController::class)->group(function () {
    Route::get('/tasks', 'index');
    Route::post('/tasks', 'store');
    Route::put('/tasks/{task}', 'update');
    Route::delete('/tasks/{task}', 'destroy');
});
