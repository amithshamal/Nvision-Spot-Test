<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {
    Route::post("register", [AuthController::class, "register"]);
    Route::post("login", [AuthController::class, "login"]);


    Route::group([
        "middleware" => ["auth:sanctum"]
    ], function () {
        Route::post('order', [OrderController::class, 'store']);
        Route::get("logout", [AuthController::class, "logout"]);
    });
});
