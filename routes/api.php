<?php

use App\Http\Controllers\Petugas\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/hashpw', [\App\Http\Controllers\Admin\UserController::class, 'hashpw'])->name('hashpw');
Route::post('/parkir/add', [\App\Http\Controllers\Admin\KelolaParkirController::class, 'add'])->name('kelola_parkir.add');
Route::get('/parkir/location', [\App\Http\Controllers\Pelanggan\DashboardController::class, 'location'])->name('kelola_parkir.location');
Route::get('/parkir/{id}', [\App\Http\Controllers\Admin\KelolaParkirController::class, 'find'])->name('kelola_parkir.find');
Route::post('/parkir/edit/{id}', [\App\Http\Controllers\Admin\KelolaParkirController::class, 'update'])->name('kelola_parkir.edit');
Route::delete('/parkir/delete/{id}', [\App\Http\Controllers\Admin\KelolaParkirController::class, 'delete'])->name('kelola_parkir.delete');
Route::post('/parking-place/{id}/update-status', [DashboardController::class, 'toggleStatus'])->name('toggleStatus');
Route::post('/update-parking-image/{id}', [DashboardController::class, 'updateImage'])->name('updateParkingImage');
Route::post('/booking', [\App\Http\Controllers\Pelanggan\DashboardController::class, 'booking'])->name('parkir.booking');
Route::post('/change-booking', [\App\Http\Controllers\Pelanggan\DashboardController::class, 'changeBookingStatus'])->name('parkir.booking.update');
Route::post('/bayar', [\App\Http\Controllers\Pelanggan\DashboardController::class, 'bayar'])->name('parkir.booking.bayar');
Route::post('/parkir/checkin', [DashboardController::class, 'checkin'])->name('parkir.booking.checkin');
Route::post('/parkir/checkout', [DashboardController::class, 'checkout'])->name('parkir.booking.checkout');
