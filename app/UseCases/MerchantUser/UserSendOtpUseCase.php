<?php

namespace App\UseCases\MerchantUser;

use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use App\Enums\ExceptionEnum\ExceptionEnum;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repository\MerchantUserRepository\MerchantUserRepositoryInterface;

class UserSendOtpUseCase
{
    public function __construct(private readonly MerchantUserRepositoryInterface $userRepository)
    {
    }

    /**
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

        Cache::remember("otp_time_{$phone}", 180, function () use ($otp) {
            return $otp;
        });

        $user->otp = $otp;
        $this->userRepository->save($user);
    }
}
