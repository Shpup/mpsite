<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ConnectionController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/connect', [ConnectionController::class, 'index'])->name('connect');
    Route::post('/connect', [ConnectionController::class, 'store']);
});

require __DIR__.'/auth.php';
