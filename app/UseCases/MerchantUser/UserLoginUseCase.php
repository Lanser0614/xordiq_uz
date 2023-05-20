<?php

namespace App\UseCases\MerchantUser;

use App\DTOs\MerchantUser\UserLoginDto;
use App\Enums\ExceptionEnum\ExceptionEnum;
use App\Repository\MerchantUserRepository\UserRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class UserLoginUseCase
{
    public function __construct(private readonly UserRepositoryInterface $userRepository)
    {
    }

    /**
     * @throws Exception
     */
    public function execute(UserLoginDto $dto): string
    {
        $user = $this->userRepository->getByPhone($dto->getPhone());

        if ($user === null) {
            throw new ModelNotFoundException(ExceptionEnum::ENTITY_NOT_FOUND->name);
        }

        if (Hash::check($dto->getPassword(), $user->password)) {
            $token = $user->createToken('xordiq.uz')->plainTextToken;
        } else {
            throw new Exception('Wrong password');
        }

        return $token;

    }
}
