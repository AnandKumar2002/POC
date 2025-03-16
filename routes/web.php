<?php

use App\Http\Controllers\ItemController;
use App\Services\ImageProcessingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('item', ItemController::class);

Route::post('/', function (Request $request) {
    $file = $request->image;

    $service = new ImageProcessingService();
    $res = $service->imageToWebp($file, '/new/123');

    if ($res) {
        return $res;
    } else {
        return 'OOOOOOps';
    }
});
