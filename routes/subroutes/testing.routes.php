<?php

use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ProjectController;

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('projects', ProjectController::class)->except('create', 'edit');
    Route::apiResource('modules', ModuleController::class)->except('create', 'edit');
});
