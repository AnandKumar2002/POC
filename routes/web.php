<?php

use App\Http\Controllers\uploadController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/upload", [uploadController::class, 'create']);
Route::post("/upload", [uploadController::class, 'store'])->name("upload.store");