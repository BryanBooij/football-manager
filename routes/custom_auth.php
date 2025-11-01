<?php

use App\Http\Controllers\CustomAuth\LoginController;
use App\Http\Controllers\CustomAuth\RegisterController;
use App\Http\Controllers\CustomAuth\ProfileController;

Route::prefix('custom')->group(function () {

    // Login
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('custom.login');
    Route::post('login', [LoginController::class, 'login']);

    // Register
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('custom.register');
    Route::post('register', [RegisterController::class, 'register']);

    // Profiel (alleen ingelogde gebruikers)
    Route::middleware(['auth'])->group(function () {
        Route::get('profile', [ProfileController::class, 'edit'])->name('custom.profile.edit');
        Route::post('profile', [ProfileController::class, 'update'])->name('custom.profile.update');
        Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::delete('profile/delete', [ProfileController::class, 'destroy'])->name('custom.profile.destroy');


});
