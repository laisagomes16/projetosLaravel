<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\ProjectController;
use App\Http\Controllers\api\v1\ClimateController;

Route::post('/v1/register', [AuthController::class, 'register']);
Route::post('/v1/login', [AuthController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    Route::post('/v1/logout', [AuthController::class, 'logout']);
    Route::get('/v1/me', [AuthController::class, 'me']);
});

Route::middleware('auth:api')->group(function () {
    Route::apiResource('v1/projects', ProjectController::class);
});

Route::middleware('auth:api')->group(function () {
    Route::get('v1/climate/fetch', [ClimateController::class, 'loadExternalClimate']);
    Route::get('v1/climate', [ClimateController::class, 'index']);
});

