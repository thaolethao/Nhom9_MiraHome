<?php

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
// Route cho trang chủ
Route::get('/', function () {
    $cartItemCount = 0;

    if (Auth::check()) {
        $cart = Cart::where('user_id', Auth::id())->first();
        if ($cart) {
            $cartItemCount = CartItem::where('cart_id', $cart->id)->count();
        }
    }

    return view('mirahome.index', compact('cartItemCount'));
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



