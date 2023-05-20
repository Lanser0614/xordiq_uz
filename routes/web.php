<?php

use Illuminate\Support\Facades\Route;
use Spatie\Image\Image;

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
    Image::load(public_path('5-merchant/rooms/44/298191684610784.png'))
        ->save(public_path('5-merchant/rooms/44.png'));
});
