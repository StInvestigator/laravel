<?php

use App\Http\Controllers\Api\InfoController;
use Illuminate\Support\Facades\Route;

Route::prefix("v1")->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
        Route::post('register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
        Route::post('logout', [\App\Http\Controllers\Api\AuthController::class, 'logout'])
        ->middleware('auth:sanctum');
        Route::get('profile', [\App\Http\Controllers\Api\AuthController::class, 'profile'])
            ->middleware('auth:sanctum');
    });

    Route::get("/infos",[InfoController::class,"index"]);
    Route::get("/info/{info}",[InfoController::class,"oneInfo"]);

    Route::get("/feedbacks/{info}",[InfoController::class,"feedbacks"]);
    Route::get("/feedbacks/last3/{info}",[InfoController::class,"last3feedbacks"]);
    Route::post("/saveFeedback/{info}",[InfoController::class,"saveFeedback"]);
});