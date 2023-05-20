<?php

namespace App\Repository\MerchantUserRepository;

use App\Models\MerchantUser;
use App\Models\User;

interface UserRepositoryInterface
{
    public function save(MerchantUser $model);

    public function getByPhone(int $phone): ?MerchantUser;

    public function getUserMerchantById(int $id,  MerchantUser $merchantUser);
}
