<?php

use App\Http\Controllers\PayuController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/payu/payment', [PayuController::class, 'payment'])->name('payu.payment');
Route::post('/payu/process', [PayUController::class, 'process'])->name('payu.process');
Route::post('/payu/success', [PayUController::class, 'success'])->name('payu.success');
Route::post('/payu/failure', [PayUController::class, 'failure'])->name('payu.failure');


// PAYU_MODE=test
// PAYU_BASE_URL=https://test.payu.in
// PAYU_VERIFY_URL=https://test.payu.in/merchant/postservice.php?form=2
// PAYU_KEY=UUG5xI
// PAYU_SALT=YQ7F4Ik4QIvRmOBY0A4lHM3J8T9P3rBA
