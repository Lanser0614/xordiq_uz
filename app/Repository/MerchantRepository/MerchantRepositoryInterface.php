<?php

namespace App\Repository\MerchantRepository;

use App\Models\Merchant;

interface MerchantRepositoryInterface
{
    public function save(Merchant $model): Merchant;


    public function getById(int $id);

    public function delete(int $id);
}
