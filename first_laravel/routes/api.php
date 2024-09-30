<?php

use App\Http\Controllers\Api\InfoController;
use Illuminate\Support\Facades\Route;

Route::prefix("v1")->group(function () {

    Route::get("/infos",[InfoController::class,"index"]);
    Route::get("/info/{info}",[InfoController::class,"oneInfo"]);

    Route::get("/feedbacks/{info}",[InfoController::class,"feedbacks"]);
    Route::get("/feedbacks/last3/{info}",[InfoController::class,"last3feedbacks"]);
    Route::post("/saveFeedback/{info}",[InfoController::class,"saveFeedback"]);
});