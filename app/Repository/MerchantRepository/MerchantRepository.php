<?php

namespace App\Repository\MerchantRepository;

use App\Models\Merchant;

class MerchantRepository implements MerchantRepositoryInterface
{

    public function save(Merchant $model): Merchant
    {
        $model->save();
        return $model;
    }

    public function getById(int $id)
    {
       return Merchant::query()->find($id);
    }

    public function delete(int $id)
    {
       return Merchant::query()->where('id', $id)->delete();
    }
}
