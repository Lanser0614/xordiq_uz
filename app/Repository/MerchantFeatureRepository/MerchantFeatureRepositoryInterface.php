<?php

namespace App\Repository\MerchantFeatureRepository;

use App\Models\MerchantFeature;

interface MerchantFeatureRepositoryInterface
{
    /**
     * @param int $id
     * @return MerchantFeature|null
     */
    public function findById(int $id): ?MerchantFeature;
    public function save(MerchantFeature $merchantFeature): MerchantFeature;

    public function delete(MerchantFeature $merchantFeature);
}
