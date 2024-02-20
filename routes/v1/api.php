<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\SpaceController;
use App\Http\Controllers\Api\V1\TaskController;
use App\Http\Controllers\Api\V1\ChecklistController;

Route::controller(UserController::class)->group(function () {
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
    Route::get('/tasks/{task}', 'show');
    Route::put('/tasks/{task}', 'update');
    Route::delete('/tasks/{task}', 'destroy');
    Route::put('/tasks/{task}/update-status', 'updateStatus');
});

Route::controller(ChecklistController::class)->group(function () {
    Route::get('/checklists', 'index');
    Route::post('/checklists', 'store');
    Route::put('/checklists/{checklist}', 'update');
    Route::put('/checklists/{checklist}/update-status', 'updateStatus');
    Route::delete('/checklists/{checklist}', 'destroy');
});
