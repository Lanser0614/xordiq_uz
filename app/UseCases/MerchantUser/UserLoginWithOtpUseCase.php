<?php

namespace App\UseCases\MerchantUser;

use App\Enums\ExceptionEnum\ExceptionEnum;
use App\Repository\MerchantUserRepository\UserRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserLoginWithOtpUseCase
{
    public function __construct(private readonly UserRepositoryInterface $userRepository)
    {
    }

    /**
     * @throws Exception
     */
    public function execute(int $phone, int $otp)
    {
        $user = $this->userRepository->getByPhone($phone);

        if ($user === null){
            throw new ModelNotFoundException(ExceptionEnum::ENTITY_NOT_FOUND->name, 404);
        }

        if ($user->otp === $otp && $user->phone_verified_at >= now()){
            $token = $user->createToken("xordiq.uz")->plainTextToken;
        }else{
            throw new Exception("Wrong otp");
        }

        return $token;

}
}
