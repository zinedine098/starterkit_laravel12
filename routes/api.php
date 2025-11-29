<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'getAuthUser']);

    Route::post('/logout', [AuthController::class, 'logout']);
});


// Public: melihat daftar kategori
Route::get('/categories', [CategoryController::class, 'index']);

// Protected: harus login
Route::middleware('auth:sanctum')->group(function () {

    // Admin only
    Route::middleware('admin')->group(function () {
        Route::post('/categories', [CategoryController::class, 'store']);
        Route::put('/categories/{category}', [CategoryController::class, 'update']);
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);
    });

    // User biasa bisa lihat detail kategori
    Route::get('/categories/{category}', [CategoryController::class, 'show']);
}); 
