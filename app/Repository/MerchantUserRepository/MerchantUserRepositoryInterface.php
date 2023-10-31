<?php

namespace App\Repository\MerchantUserRepository;

use App\Models\Merchant\MerchantUser;

interface MerchantUserRepositoryInterface {
    public function getUserMerchants(MerchantUser $merchantUser, int $perPage = 1, int $page = 1);

    public function save(MerchantUser $model);

    public function getByPhone(int $phone): ?MerchantUser;

    public function getById(int $id): ?MerchantUser;

    public function getUserMerchantById(int $id, MerchantUser $merchantUser);

    public function deleteMerchantFromUser(MerchantUser $merchantUser, int $merchantId);
}
