<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Room\RoomController;
use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\Merchant\MerchantController;
use App\Http\Controllers\Api\RoomFeature\RoomFeatureController;
use App\Http\Controllers\Api\MerchantFeature\MerchantFeatureController;

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'getCategories']);
    Route::post('/', [CategoryController::class, 'store']);
    Route::put('/{id}', [CategoryController::class, 'update']);
    Route::delete('/{id}', [CategoryController::class, 'delete']);
});

Route::prefix('merchants')->group(function () {
    Route::post('/', [MerchantController::class, 'store']);
    Route::get('/', [MerchantController::class, 'index']);
    Route::get('/{id}', [MerchantController::class, 'show']);
    Route::post('/{id}', [MerchantController::class, 'update']);
    Route::delete('/{id}', [MerchantController::class, 'delete']);
    Route::delete('/{id}/{category_id}', [MerchantController::class, 'setCategory']);
});

Route::prefix('merchants-feature')->group(function () {
    Route::post('/', [MerchantFeatureController::class, 'store']);
    Route::get('/', [MerchantFeatureController::class, 'index']);
    Route::post('/{id}', [MerchantFeatureController::class, 'update']);
    Route::delete('/{id}', [MerchantFeatureController::class, 'delete']);
});

Route::prefix('merchant')->group(function () {
    Route::post('/{merchant_id}/room', [RoomController::class, 'store']);
    Route::get('/{merchant_id}/room', [RoomController::class, 'index']);
    Route::post('/{merchant_id}/room/{room_id}', [RoomController::class, 'update']);
    Route::get('/{merchant_id}/room/{room_id}', [RoomController::class, 'show']);
    Route::delete('/{merchant_id}/room/{room_id}', [RoomController::class, 'delete']);
});

Route::prefix('room-feature')->group(function () {
    Route::post('/', [RoomFeatureController::class, 'store']);
    Route::get('/', [RoomFeatureController::class, 'index']);
    Route::post('/{id}', [RoomFeatureController::class, 'update']);
    Route::delete('/{id}', [RoomFeatureController::class, 'delete']);
});
