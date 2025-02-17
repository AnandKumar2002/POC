<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// routes/web.php
use App\Http\Controllers\PageController;

Route::post('/pages', [PageController::class, 'store']);
Route::get('/pages/{id}', [PageController::class, 'show']);

