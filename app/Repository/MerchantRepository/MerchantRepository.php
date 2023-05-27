<?php

namespace App\Repository\MerchantRepository;

use App\Models\Merchant;
use App\Models\MerchantUser;
use Illuminate\Database\Eloquent\Builder;

class MerchantRepository implements MerchantRepositoryInterface
{
    public function save(Merchant $model): Merchant
    {
        $model->save();

        return $model;
    }

    public function getById(int $id): ?Merchant
    {
        return Merchant::query()->find($id);
    }

    public function delete(int $id)
    {
        return Merchant::query()->where('id', $id)->delete();
    }

    public function getMerchantRooms(int $merchantId, MerchantUser $merchantUser)
    {
        return Merchant::query()->with(['rooms.images'])->where('id', $merchantId)
            ->whereHas('merchantsUser', function (Builder $query) use ($merchantUser) {
                $query->where('id', $merchantUser->id);
            })->first();
    }
}
