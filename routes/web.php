<?php

use App\Http\Controllers\PackageController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', [TestController::class, 'testConnection']);
Route::get('/packages', [PackageController::class, 'index']);
Route::post('/ai/generate-itinerary', [PackageController::class, 'generateItinerary']);
