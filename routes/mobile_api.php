<?php

use App\Http\Controllers\Api\Mobile\MobileApiController;
use App\Http\Controllers\Api\Mobile\MobileUserController;
use Illuminate\Support\Facades\Route;

Route::prefix('merchants')->group(function () {
    Route::get('/', [MobileApiController::class, 'merchantIndex']);
    Route::get('/{id}', [MobileApiController::class, 'showMerchant']);
    Route::post('/get-merchant-distance', [MobileApiController::class, 'getMerchantDistance']);
});

Route::prefix('users')->group(function () {
    Route::post('/register', [MobileUserController::class, 'register']);
    Route::post('/verify-otp', [MobileUserController::class, 'loginWithOtp']);
    Route::post('/login', [MobileUserController::class, 'login']);
});
Route::prefix('users')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::post('add-favorite', [MobileUserController::class, 'addFavorites']);
    });

Route::prefix('categories')->group(function () {
    Route::get('/', [MobileApiController::class, 'merchantCategories']);
    //    Route::get('/{id}', [MobileApiController::class, 'show']);
});
