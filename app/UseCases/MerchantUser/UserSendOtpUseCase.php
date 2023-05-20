<?php

namespace App\UseCases\MerchantUser;

use App\Enums\ExceptionEnum\ExceptionEnum;
use App\Repository\MerchantUserRepository\UserRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\App;

class UserSendOtpUseCase
{
    public function __construct(private readonly UserRepositoryInterface $userRepository)
    {
    }

    /**
     * @param int $phone
     * @return void
     * @throws Exception
     */
    public function execute(int $phone): void
    {
        $user = $this->userRepository->getByPhone($phone);

        if ($user === null) {
            throw new ModelNotFoundException(ExceptionEnum::ENTITY_NOT_FOUND->name);
        }

        if (App::isProduction()) {
            $otp = random_int(1000, 9999);
        } else {
            $otp = 1111;
        }

        $user->phone_verified_at = Carbon::now()->addMinutes();
        $user->otp = $otp;
        $this->userRepository->save($user);
    }
}
