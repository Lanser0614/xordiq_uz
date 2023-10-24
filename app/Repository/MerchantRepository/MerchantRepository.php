<?php

namespace App\Repository\MerchantRepository;

use App\Models\Merchant;
use App\Models\MerchantUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class MerchantRepository implements MerchantRepositoryInterface {
    public function save(Merchant $model): Merchant {
        $model->save();

        return $model;
    }

    public function getById(int $id): ?Merchant {
        return Merchant::query()->find($id);
    }

    /**
     * @return mixed
     */
    public function delete(int $id) {
        return Merchant::query()->where('id', $id)->delete();
    }

    /**
     * @return Builder|Model|object|null
     */
    public function getMerchantRooms(int $merchantId, MerchantUser $merchantUser) {
        return Merchant::query()->with(['rooms.images'])->where('id', $merchantId)
            ->whereHas('merchantsUser', function (Builder $query) use ($merchantUser) {
                $query->where('id', $merchantUser->id);
            })->first();
    }

    public function saveMerchantUser(Merchant $model): void {
        $model->merchantsUser()->sync(auth()->user());
    }

    public function saveMerchantCategory(Merchant $model, array $categoryIds): void {
        $model->merchantsCategories()->sync($categoryIds);
    }

    public function saveMerchantFeatures(Merchant $model, array $merchantFeaturesIds): void {
        $model->merchantsFeatures()->sync($merchantFeaturesIds);
    }
}
