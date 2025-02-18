<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::redirect('/', '/login');

/**
 * ---------------------------
 * Authentication Routes
 * ---------------------------
 */
Route::view('/login', 'auth.login')->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/**
 * ---------------------------
 * Admin Routes
 * ---------------------------
 */
Route::middleware('auth')->group(function() {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::resource('pages', PageController::class);
});


/**
 * ------------------------------
 * Test Routes
 * ------------------------------
 */
Route::controller(TestController::class)->prefix('/test')->group(function() {
    Route::view('page','test.page');
});