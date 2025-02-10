<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApartmentController;
use App\Http\Middleware\VerifyApartmentOwner;


Route::post('/signin', [AuthController::class, 'signin']);
Route::post('/login', [AuthController::class, 'login']);


Route::apiResource('/apartments', ApartmentController::class)->only(['index', 'show']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/apartments', [ApartmentController::class, 'store']);
    Route::put('/apartments/{id}', [ApartmentController::class, 'update']);

    Route::middleware('auth:sanctum')->put('/apartments/{id}', [ApartmentController::class, 'update']);
});