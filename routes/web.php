<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
// Route cho trang chủ
Route::get('/', function () {
    return view('mirahome.index');
});

// Route cho giỏ hàng
Route::get('/cart', [CartController::class, 'index'])->name('cart');

// Route cho thanh toán
Route::post('/confirm-momo', [PaymentController::class, 'confirm_momo'])->name('confirm.momo');
Route::get('/momo-return', [PaymentController::class, 'momoReturn']);
Route::post('/momo-notify', [PaymentController::class, 'momoNotify']);



// Route cho checkout
Route::get('/checkout', [PaymentController::class, 'index'])->name('checkout');
Route::post('/checkout', [PaymentController::class, 'process'])->name('checkout.process');


Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);



