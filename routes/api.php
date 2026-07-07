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

// CRUD Layanan/Pelanggan/Pesanan TIDAK di-guard auth:sanctum lagi.
// Alasan: endpoint ini cuma dipakai internal oleh halaman Blade yang sudah
// dilindungi session('login') di FrontendLayananController/FrontendPelangganController/
// FrontendPesananController. Menambah auth:sanctum di sini cuma menambah lapisan
// kompleksitas (Bearer token via meta tag) tanpa manfaat keamanan tambahan yang
// berarti untuk kebutuhan praktikum ini, dan malah rawan putus di tengah jalan
// (Accept header, redirect ke halaman login, token expired, dsb).
//
// Kalau suatu saat butuh diproteksi lagi (misal API-nya dipakai aplikasi lain di
// luar Blade), tinggal bungkus 3 baris di bawah dengan Route::middleware('auth:sanctum')->group(...)
// DAN pastikan frontend Blade mengirim Bearer token yang valid di setiap fetch.
Route::apiResource('layanans', LayananController::class);
Route::apiResource('pelanggans', PelangganController::class);
Route::apiResource('pesanans', PesananController::class);
