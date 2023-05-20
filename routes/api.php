<?php

use App\Http\Controllers\Api\Merchant\MerchantController;
use App\Http\Controllers\Api\MerchantUser\UserController;
use App\Http\Controllers\Api\Room\RoomController;
use App\Http\Middleware\User\CheckMerchantUserMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum', CheckMerchantUserMiddleware::class])->group(function () {

    Route::prefix("merchants")->group(function (){
        Route::post('/', [MerchantController::class, 'store']);
        Route::post('/{id}', [MerchantController::class, 'update']);
        Route::delete('/{id}', [MerchantController::class, 'delete']);
    });

    Route::prefix("rooms")->group(function (){
        Route::post('/{merchant_id}', [RoomController::class, 'store']);
        Route::post('/{merchant_id}/{room_id}', [RoomController::class, 'update']);

    });
});



Route::prefix("merchant_user")->group(function (){
    Route::post("/login", [UserController::class, 'login']);
    Route::post("/sendOtp", [UserController::class, "sendOtp"]);
    Route::post("/loginWithOtp", [UserController::class, 'loginWithOtp']);
    Route::post("/register", [UserController::class, 'register']);
});



