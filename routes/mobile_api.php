<?php

use App\Http\Controllers\Api\Mobile\MobileApiController;
use Illuminate\Support\Facades\Route;

Route::prefix('merchants')->group(function () {
    Route::get('/', [MobileApiController::class, 'merchantIndex']);
    Route::post('/get-merchant-distance', [MobileApiController::class, 'getMerchantDistance']);
    //    Route::get('/{id}', [MobileApiController::class, 'show']);
});

Route::prefix('categories')->group(function () {
    Route::get('/', [MobileApiController::class, 'merchantCategories']);
    //    Route::get('/{id}', [MobileApiController::class, 'show']);
});
