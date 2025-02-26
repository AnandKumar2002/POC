<?php

use App\Http\Controllers\SFTPController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/download-file', [SFTPController::class, 'downloadFile']);
Route::get('/check', [SFTPController::class, 'checkSftpConnection']);
