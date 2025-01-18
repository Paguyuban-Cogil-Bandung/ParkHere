<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/hashpw', [\App\Http\Controllers\Admin\UserController::class, 'hashpw'])->name('hashpw');
