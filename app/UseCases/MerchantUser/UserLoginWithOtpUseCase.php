<?php

namespace App\UseCases\MerchantUser;

use App\Enums\ExceptionEnum\ExceptionEnum;
use App\Repository\MerchantUserRepository\MerchantUserRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserLoginWithOtpUseCase
{
    public function __construct(private readonly MerchantUserRepositoryInterface $userRepository)
    {
    }

    /**
     * @param  int  $phone
     * @param  int  $otp
     * @return string
     *
     * @throws Exception
     */
    public function execute(int $phone, int $otp): string
    {
        $user = $this->userRepository->getByPhone($phone);

        if ($user === null) {
            throw new ModelNotFoundException(ExceptionEnum::ENTITY_NOT_FOUND->name, 404);
        }

        if ($user->otp === $otp && $user->phone_verified_at >= now()) {
            $token = $user->createToken('xordiq.uz')->plainTextToken;
        } else {
            throw new Exception('Wrong otp');
        }

        return $token;
    }
}
