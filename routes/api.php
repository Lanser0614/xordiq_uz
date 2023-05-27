<?php

use App\Http\Controllers\Api\MerchantUser\MerchantUserController;
use App\Http\Controllers\Api\Region\RegionController;
use App\Models\User;
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

Route::get('/regions', [RegionController::class, 'getRegions']);
Route::get('/regions/districts/{region_id}', [RegionController::class, 'getDistricts']);
Route::get('/regions/villages/{district_id}', [RegionController::class, 'getVillage']);

Route::prefix('merchant_user')->group(function () {
    Route::post('/login', [MerchantUserController::class, 'login']);
    Route::post('/sendOtp', [MerchantUserController::class, 'sendOtp']);
    Route::post('/loginWithOtp', [MerchantUserController::class, 'loginWithOtp']);
    Route::post('/register', [MerchantUserController::class, 'register']);
});

Route::get('/test', function () {
    $user = User::query()->paginate();

    return responseWithPagination($user);
});
