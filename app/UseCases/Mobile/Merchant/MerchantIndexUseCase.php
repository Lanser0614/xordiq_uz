<?php
declare(strict_types=1);

namespace App\UseCases\Mobile\Merchant;

use App\Filter\EloquentFilter\Merchant\MerchantByCategory;
use App\Models\Merchant;
use Illuminate\Http\Request;

class MerchantIndexUseCase
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function perform(Request $request) {
        return Merchant::query()
            ->filter(
                $request,
                [
                    MerchantByCategory::class
                ]
            )
            ->with(['rooms' => function ($query) {
                $query->orderBy('price');
            }])
            ->paginate($request->perPage ?? 15);
    }
}
