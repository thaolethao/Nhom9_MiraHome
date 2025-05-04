<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/products', [ApiController::class, 'getProducts']);
Route::get('/products/{id}', [ApiController::class, 'getProduct']);
Route::post('/products', [ApiController::class, 'createProduct']);
Route::put('/products/{id}', [ApiController::class, 'updateProduct']); //update toàn bộ
Route::patch('/products/{id}', [ApiController::class, 'patchProduct']); //update phần sửa
Route::delete('/products/{id}', [ApiController::class, 'deleteProduct']);


use App\Http\Controllers\AuthController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('profile', [AuthController::class, 'profile']);
});