<?php

namespace App\Repository\MerchantRepository;

use App\Models\Merchant;
use App\Models\MerchantUser;

interface MerchantRepositoryInterface
{
    public function save(Merchant $model): Merchant;


    public function getById(int $id);

    public function delete(int $id);

    public function getMerchantRooms(int $merchantId, MerchantUser $merchantUser);
}
