<?php

namespace App\Repository\MerchantRepository;

use App\Enums\MerchantUser\MerchantUserRolesEnum;
use App\Models\Merchant\Merchant;
use App\Models\Merchant\MerchantUser;
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
    public function getMerchantRooms(int $merchantId, MerchantUser $merchantUser): Merchant {
        return Merchant::query()->with(['rooms.images'])->where('id', $merchantId)
            ->whereHas('merchantsUser', function (Builder $query) use ($merchantUser) {
                $query->where('merchant_user_id', $merchantUser->id);
            })
        ->first();
    }

    public function saveMerchantUser(Merchant $merchant, MerchantUserRolesEnum $role, MerchantUser $merchantUser): void {
        $merchant->merchantsUser()->attach([
            $merchant->id => ['role' => $role->getValue(), 'merchant_user_id' => $merchantUser->id],
        ]);
    }

    public function saveMerchantCategory(Merchant $model, array $categoryIds): void {
        $model->merchantsCategories()->sync($categoryIds);
    }

    public function saveMerchantFeatures(Merchant $model, array $merchantFeaturesIds): void {
        $model->merchantsFeatures()->sync($merchantFeaturesIds);
    }
}
