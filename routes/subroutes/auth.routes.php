<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('sign-up', [AuthController::class, 'register']);
Route::post('sign-in', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('auth/user', [AuthController::class, 'getUser']);
});
