<?php

namespace App\Repository\MerchantFeatureRepository;

use App\Models\Merchant\MerchantFeature;

class MerchantFeatureRepository implements MerchantFeatureRepositoryInterface {
    public function save(MerchantFeature $merchantFeature): MerchantFeature {
        $merchantFeature->save();

        return $merchantFeature;
    }

    public function findById(int $id): ?MerchantFeature {
        return MerchantFeature::query()->findOrFail($id);
    }

    public function delete(MerchantFeature $merchantFeature) {
        return $merchantFeature->delete();
    }
}
