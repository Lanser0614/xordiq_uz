<?php

namespace App\UseCases\Admin\MerchantUser;

use App\Enums\ExceptionEnum\ExceptionEnum;
use App\Exceptions\BusinessException;
use App\Repository\MerchantUserRepository\MerchantUserRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cache;

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
