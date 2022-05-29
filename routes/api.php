<?php

use App\Http\Controllers\CartItemController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {

    Route::post('/login', [UserController::class, 'login']);

    Route::post('/register', [UserController::class, 'register']);

    Route::middleware('auth:sanctum')->group(function () {

        Route::post('logout', [UserController::class, 'logout']);

        Route::get('user', [UserController::class, 'user']);
    });
});

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/upload/image', [UploadController::class, 'uploadImage']);

    Route::resource('products', ProductController::class)->only([
        'index', 'store', 'show', 'update', 'destroy'
    ]);

    Route::resource('product-categories', ProductCategoryController::class)->only([
        'index', 'store', 'show', 'update', 'destroy'
    ]);

    Route::resource('cart-items', CartItemController::class)->only([
        'index', 'store', 'show', 'update', 'destroy'
    ]);
});
