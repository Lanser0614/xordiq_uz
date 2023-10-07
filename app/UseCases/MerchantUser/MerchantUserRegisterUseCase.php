<?php

namespace App\UseCases\MerchantUser;

use Exception;
use App\Models\MerchantUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\DataBaseException;
use Illuminate\Support\Facades\Cache;
use App\Enums\MerchantUser\MerchantUserRolesEnum;
use App\DTOs\MerchantUser\MerchantUserRegisterDto;
use App\Repository\MerchantUserRepository\MerchantUserRepositoryInterface;

class MerchantUserRegisterUseCase
{
    public function __construct(private readonly MerchantUserRepositoryInterface $userRepository)
    {
    }

    /**
     * @throws Exception
     */
    public function execute(MerchantUserRegisterDto $dto): void
    {
        if (App::isProduction()) {
            $otp = random_int(1000, 9999);
        } else {
            $otp = 1111;
        }

        //        $user = $this->userRepository->getByPhone($dto->getPhone());
        //
        //        if ($user) {
        //            throw new DataBaseException('phoneNumber already have');
        //        }

        $merchantUser = new MerchantUser;
        $merchantUser->phone = $dto->getPhone();
        $merchantUser->password = Hash::make($dto->getPassword());
        $merchantUser->name = $dto->getName();
        $merchantUser->surname = $dto->getSurname();
        $merchantUser->email = $dto->getEmail();
        $merchantUser->otp = $otp;
        $merchantUser->role = MerchantUserRolesEnum::ADMIN;

        Cache::remember("otp_time_{$merchantUser->phone}", 180, function () use ($otp) {
            return $otp;
        });

        DB::transaction(function () use ($merchantUser) {
            $this->userRepository->save($merchantUser);
        });
    }
}
