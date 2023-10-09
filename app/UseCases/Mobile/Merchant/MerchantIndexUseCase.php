<?php

declare(strict_types=1);

namespace App\UseCases\Mobile\Merchant;

use App\Models\Merchant;
use Illuminate\Http\Request;
use App\Filter\EloquentFilter\Merchant\MerchantByCategory;

class MerchantIndexUseCase
{
    /**
     * @return mixed
     */
    public function perform(Request $request)
    {
        return Merchant::query()
            ->filter(
                $request,
                [
                    MerchantByCategory::class,
                ]
            )
            ->with([
                'rooms' => function ($query) {
                    $query->orderBy('price');
                },
                'images',
            ])
            ->paginate($request->perPage ?? 15);
    }
}
