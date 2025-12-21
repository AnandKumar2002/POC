<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::view('/admin-dashboard', 'admin-dashboard')->name('admin.dashboard');
});


require __DIR__ . '/auth.php';
