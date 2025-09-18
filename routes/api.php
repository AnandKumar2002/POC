<?php

use App\Http\Controllers\StreamController;
use App\Http\Controllers\UserStreamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users-stream', [UserStreamController::class, 'stream']);
