<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiAuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/login', [ApiAuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [ApiAuthController::class, 'logout']);
