<?php

namespace App\UseCases\MerchantUser;

use App\DTOs\MerchantUser\MerchantUserRegisterDto;
use App\Enums\MerchantUser\MerchantUserRolesEnum;
use App\Exceptions\DataBaseException;
use App\Models\MerchantUser;
use App\Repository\MerchantUserRepository\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MerchantUserRegisterUseCase
{
    public function __construct(private readonly UserRepositoryInterface $userRepository)
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

        $user = $this->userRepository->getByPhone($dto->getPhone());

        if ($user) {
            throw new DataBaseException('phoneNumber already have');
        }

        $merchantUser = new MerchantUser();
        $merchantUser->phone = $dto->getPhone();
        $merchantUser->password = Hash::make($dto->getPassword());
        $merchantUser->name = $dto->getName();
        $merchantUser->surname = $dto->getSurname();
        $merchantUser->email = $dto->getEmail();
        $merchantUser->otp = $otp;
        $merchantUser->role = MerchantUserRolesEnum::ADMIN;
        $merchantUser->phone_verified_at = now()->addMinutes(2);
        DB::transaction(function () use ($merchantUser) {
            $this->userRepository->save($merchantUser);
        });
    }
}
