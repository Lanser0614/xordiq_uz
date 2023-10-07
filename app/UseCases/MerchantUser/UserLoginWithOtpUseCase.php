<?php

namespace App\UseCases\MerchantUser;

use Exception;
use App\Exceptions\BusinessException;
use Illuminate\Support\Facades\Cache;
use App\Enums\ExceptionEnum\ExceptionEnum;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repository\MerchantUserRepository\MerchantUserRepositoryInterface;

class UserLoginWithOtpUseCase
{
    public function __construct(private readonly MerchantUserRepositoryInterface $userRepository)
    {
    }

    /**
     * @throws Exception
     */
    public function execute(int $phone, int $otp): string
    {
        $user = $this->userRepository->getByPhone($phone);

        if ($user === null) {
            throw new ModelNotFoundException(ExceptionEnum::ENTITY_NOT_FOUND->name, 404);
        }

        if (Cache::get('otp_time_' . $phone) === $otp) {
            $token = $user->createToken('xordiq.uz')->plainTextToken;
        } else {
            throw new BusinessException('Wrong otp');
        }

        return $token;
    }
}
