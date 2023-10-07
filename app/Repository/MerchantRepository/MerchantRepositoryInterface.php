<?php

namespace App\Repository\MerchantRepository;

use App\Models\Merchant;
use App\Models\MerchantUser;

interface MerchantRepositoryInterface
{
    public function save(Merchant $model): Merchant;

    public function saveMerchantUser(Merchant $model): void;

    public function saveMerchantCategory(Merchant $model, array $categoryIds): void;

    public function getById(int $id): ?Merchant;

    /**
     * @return mixed
     */
    public function delete(int $id);

    /**
     * @return mixed
     */
    public function getMerchantRooms(int $merchantId, MerchantUser $merchantUser);

    /**
     * @return mixed
     */
    public function saveMerchantFeatures(Merchant $model, array $merchantFeaturesIds);
}
