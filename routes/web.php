<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ConnectionController;
Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/connect', [ConnectionController::class, 'index'])->name('connect');
    Route::post('/connect', [ConnectionController::class, 'store']);
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update_password');});

require __DIR__.'/auth.php';
