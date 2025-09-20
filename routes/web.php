<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update_password');
    Route::post('/profile/connect-store', [ProfileController::class, 'connectStore'])->name('profile.connect_store');
    Route::put('/profile/update-store/{id}', [ProfileController::class, 'updateStore'])->name('profile.update_store');
    Route::delete('/profile/delete-store/{id}', [ProfileController::class, 'deleteStore'])->name('profile.delete_store');
});
require __DIR__.'/auth.php';
