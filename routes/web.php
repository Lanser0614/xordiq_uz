<?php

use App\Http\Resources\Mobile\MerchantMobileResource;
use App\Models\Merchant;
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
    $paginate = MerchantMobileResource::collection(Merchant::query()->paginate());

    dd($paginate);

    return [
        'result' => $paginate->resource->items(),
        'paginator' => [
            'perPage' => $paginate->resource->perPage(),
            'total' => $paginate->resource->total(),
            'currentPage' => $paginate->resource->currentPage(),
            'lastaPage' => $paginate->resource->lastPage(),
        ],
    ];
    //
});
