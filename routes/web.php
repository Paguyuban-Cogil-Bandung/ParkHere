<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('welcome');})->name('welcome');


Route::middleware(['pelanggan', 'auth', 'dontback'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Pelanggan\DashboardController::class, 'view'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->name('admin.')->middleware(['admin', 'auth', 'dontback'])->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'view'])->name('dashboard');
    Route::get('user', [\App\Http\Controllers\Admin\UserController::class, 'view'])->name('user');
    Route::get('parkir', [\App\Http\Controllers\Admin\KelolaParkirController::class, 'view'])->name('kelola_parkir');
    Route::get('laporan', [\App\Http\Controllers\Admin\LaporanTransaksiController::class, 'view'])->name('laporan_transaksi');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('petugas')->name('petugas.')->middleware(['petugas', 'auth','dontback'])->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\Petugas\DashboardController::class, 'view'])->name('dashboard');
    Route::get('laporan', [\App\Http\Controllers\Petugas\LaporanTransaksiController::class, 'view'])->name('laporan_transaksi');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
