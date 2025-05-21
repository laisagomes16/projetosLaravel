<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\ProjectController;
use App\Http\Controllers\api\v1\ClimateController;

Route::post('/v1/register', [AuthController::class, 'register']);


/*Route::post('/v1/login', [AuthController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    Route::post('/v1/logout', [AuthController::class, 'logout']);
    Route::get('/v1/me', [AuthController::class, 'me']);
});*/

Route::post('/v1/login', [AuthController::class, 'login']);
Route::prefix('v1/auth')->group(function () {
    //Route::post('/login', [AuthController::class, 'login']);
    Route::post('/login/google', [AuthController::class, 'loginWithGoogle']);

    Route::middleware('auth:api')->group(function () {
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::get('/user-profile', [AuthController::class, 'userProfile']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});

Route::middleware('auth:api')->group(function () {
    Route::apiResource('v1/projects', ProjectController::class);
});

Route::middleware('auth:api')->group(function () {
    Route::get('v1/climate/fetch', [ClimateController::class, 'loadExternalClimate']);
    Route::get('v1/climate', [ClimateController::class, 'index']);
});

Route::post('/v1/auth/google', [AuthController::class, 'loginWithGoogle']);

