<?php

use App\Http\Controllers\Api\InfoController;
use Illuminate\Support\Facades\Route;

Route::prefix("v1")->group(function () {

    Route::get("/infos",[InfoController::class,"index"]);
    Route::get("/info/{info}",[InfoController::class,"oneInfo"]);

    Route::get("/feedback/{feedback}",[InfoController::class,"feedback"]);
});