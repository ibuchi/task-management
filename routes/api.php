<?php

use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ProjectUserController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\UserProjectController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::prefix('/auth')->group(function () {
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::controller(AuthenticatedSessionController::class)->group(function () {
        Route::post('/login', 'store');
        Route::post('/logout', 'destroy')->name('logout')->middleware(['auth:sanctum']);
    });
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('projects',              ProjectController::class);
    Route::apiResource('tasks',                 TaskController::class);
    Route::apiResource('users.user-projects',   UserProjectController::class)
        ->shallow()
        ->parameter('user-projects', 'project')
        ->only(['update', 'destroy']);
    Route::apiResource('teams',                 TeamController::class);
});
