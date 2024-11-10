<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\OtpController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/product/all', [ProductController::class, 'getAllProducts'])->name('product.all');
Route::get('/category/all', [CategoryController::class, 'getAllCategories'])->name('category.all');


Route::post('send-otp', [OtpController::class, 'sendOtp']);
Route::post('verify-otp', [OtpController::class, 'verifyOtp']);
