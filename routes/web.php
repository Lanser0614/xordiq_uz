<?php

use App\Models\Merchant\Merchant;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $merchants = Merchant::query()->whereIn('id', [111, 109, 108])->get();

    $merchants->map(function (Merchant $merchant) {
        $merchant->title_en = 'test1';
        unset($merchant->created_at);
        unset($merchant->updated_at);
    });

    Merchant::query()->upsert($merchants->toArray(), 'id');
});
