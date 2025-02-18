<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.admin');
});

Route::post('/logout', function() {

})->name('logout');
Route::post('/dashboard', function() {

})->name('dashboard');

Route::controller(TestController::class)->prefix('/test')->group(function() {
    Route::view('page','test.page');
});