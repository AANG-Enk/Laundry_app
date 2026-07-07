<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FrontendLayananController;
use App\Http\Controllers\FrontendPelangganController;
use App\Http\Controllers\FrontendPesananController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');

Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

Route::get('/selamat-datang', function () {
    return view('selamatdatang');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/dashboard', function () {
    if (!session('login')) {
        return redirect('/login');
    }
    return view('dashboard');
});


Route::get('/layanan', [FrontendLayananController::class, 'index'])->name('layanan.index');
Route::get('/layanan/create', [FrontendLayananController::class, 'create'])->name('layanan.create');
Route::get('/layanan/edit/{id}', [FrontendLayananController::class, 'edit'])->name('layanan.edit');
// Tambahkan baris ini ke routes/web.php, di dekat route /layanan lainnya
Route::post('/layanan/import', [FrontendLayananController::class, 'import'])->name('layanan.import');

Route::get('/pelanggan', [FrontendPelangganController::class, 'index'])->name('pelanggan.index');
Route::get('/pelanggan/create', [FrontendPelangganController::class, 'create'])->name('pelanggan.create');
Route::get('/pelanggan/edit/{id}', [FrontendPelangganController::class, 'edit'])->name('pelanggan.edit');

Route::get('/pesanan', [FrontendPesananController::class, 'index'])->name('pesanan.index');
Route::get('/pesanan/create', [FrontendPesananController::class, 'create'])->name('pesanan.create');
Route::get('/pesanan/edit/{id}', [FrontendPesananController::class, 'edit'])->name('pesanan.edit');
