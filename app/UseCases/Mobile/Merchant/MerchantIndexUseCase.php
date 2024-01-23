<?php

declare(strict_types=1);

namespace App\UseCases\Mobile\Merchant;

use App\Filter\EloquentFilter\Merchant\MerchantByCategory;
use App\Filter\EloquentFilter\Merchant\MerchantByEnTitle;
use App\Filter\EloquentFilter\Merchant\MerchantByIds;
use App\Filter\EloquentFilter\Merchant\MerchantByRuTitle;
use App\Filter\EloquentFilter\Merchant\MerchantByUzTitle;
use App\Http\Resources\Mobile\MerchantMobileResource;
use App\Models\Merchant\Merchant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MerchantIndexUseCase {
    /**
     * @return mixed
     */
    public function perform(Request $request): AnonymousResourceCollection {
        $merchants = Merchant::query()
            ->filter(
                $request,
                [
                    MerchantByIds::class,
                    MerchantByCategory::class,
                    MerchantByEnTitle::class,
                    MerchantByRuTitle::class,
                    MerchantByUzTitle::class,
                ]
            )
            ->with([
                'rooms' => function ($query) {
                    $query->orderBy('price');
                },
                'images',
            ])
            ->paginate($request->perPage ?? 15);

        return MerchantMobileResource::collection($merchants);
    }
}
