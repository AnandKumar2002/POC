<?php

use App\Http\Controllers\Web\Auth\PasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Auth\RegisterController;

// Routes for guests (not logged in)
Route::middleware('guest')->group(function () {

    // Registration
    Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);

    // Login
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);

    // Password Reset
    Route::get('forgot-password', [PasswordController::class, 'showForgotForm'])->name('password.request');
    Route::post('forgot-password', [PasswordController::class, 'sendPasswordResetLink'])->name('password.email');

    Route::get('reset-password/{token}', [PasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [PasswordController::class, 'resetPassword'])->name('password.store');
});

// Routes for authenticated users
Route::middleware('auth')->group(function () {

    // Update Password
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    // Logout
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
