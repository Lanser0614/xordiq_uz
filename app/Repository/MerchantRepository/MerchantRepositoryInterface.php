<?php

namespace App\Repository\MerchantRepository;

use App\Enums\MerchantUser\MerchantUserRolesEnum;
use App\Models\Merchant\Merchant;
use App\Models\Merchant\MerchantUser;

interface MerchantRepositoryInterface {
    public function save(Merchant $model): Merchant;

    public function saveMerchantUser(Merchant $merchant, MerchantUserRolesEnum $role, MerchantUser $merchantUser): void;

    public function saveMerchantCategory(Merchant $model, array $categoryIds): void;

    public function getById(int $id): ?Merchant;

    /**
     * @return mixed
     */
    public function delete(int $id);

    /**
     * @return mixed
     */
    public function getMerchantRooms(int $merchantId, MerchantUser $merchantUser): Merchant;

    /**
     * @return mixed
     */
    public function saveMerchantFeatures(Merchant $model, array $merchantFeaturesIds);
}
