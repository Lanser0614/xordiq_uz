<?php

namespace App\Repository\MerchantFeatureRepository;

use App\Models\Merchant\MerchantFeature;

interface MerchantFeatureRepositoryInterface {
    public function findById(int $id): ?MerchantFeature;

    public function save(MerchantFeature $merchantFeature): MerchantFeature;

    public function delete(MerchantFeature $merchantFeature);
}
