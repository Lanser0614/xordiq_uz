<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Mobile\MobileApiController;

Route::prefix('merchants')->group(function () {
    Route::get('/', [MobileApiController::class, 'merchantIndex']);
    Route::post('/get-merchant-distance', [MobileApiController::class, 'getMerchantDistance']);
    //    Route::get('/{id}', [MobileApiController::class, 'show']);
});

Route::prefix('categories')->group(function () {
    Route::get('/', [MobileApiController::class, 'merchantCategories']);
    //    Route::get('/{id}', [MobileApiController::class, 'show']);
});
