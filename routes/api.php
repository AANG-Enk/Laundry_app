<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LayananController;
use App\Http\Controllers\Api\PelangganController;
use App\Http\Controllers\Api\PesananController;

Route::post('/login', [AuthController::class, 'login']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('layanans',LayananController::class);
    Route::apiResource('pelanggans',PelangganController::class);
    Route::apiResource('pesanans',PesananController::class);
});
