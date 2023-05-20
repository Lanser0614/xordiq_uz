<?php

namespace App\Repository\MerchantUserRepository;

use App\Models\MerchantUser;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserRepository implements UserRepositoryInterface
{


    public function save(MerchantUser $model): MerchantUser
    {
        $model->save();
        return $model;
    }

    public function getByPhone(int $phone): ?MerchantUser
    {
        return MerchantUser::query()->where('phone', $phone)->first();
    }

    public function getUserMerchantById(int $id, MerchantUser $merchantUser): Model|Collection|null
    {
        return $merchantUser->merchants()->find($id);
    }


    public function deleteMerchantFromUser(MerchantUser $merchantUser, int $merchantId): int
    {
        return $merchantUser->merchants()->detach($merchantId);
    }

    public function getUserMerchants(MerchantUser $merchantUser, int $perPage = 15, int $page = 1): LengthAwarePaginator
    {
        return $merchantUser->merchants()->with(["images"])->paginate($perPage, ["*"], $page);
    }
}
