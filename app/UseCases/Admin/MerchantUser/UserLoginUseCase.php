<?php

namespace App\UseCases\Admin\MerchantUser;

use App\DTOs\MerchantDTOs\MerchantUser\UserLoginDto;
use App\Exceptions\BusinessException;
use App\Repository\MerchantUserRepository\MerchantUserRepositoryInterface;
use App\Tasks\Checker\CheckEntityTask;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserLoginUseCase {
    public function __construct(
        private readonly MerchantUserRepositoryInterface $merchantUserRepository,
        private readonly CheckEntityTask $checkEntityTask
    ) {
    }

    /**
     * @throws Exception
     */
    public function execute(UserLoginDto $dto): string {
        $user = $this->merchantUserRepository->getByPhone($dto->getPhone());

        $this->checkEntityTask->run($user);

        if (Hash::check($dto->getPassword(), $user->password)) {
            $token = $user->createToken('xordiq.uz')->plainTextToken;
        } else {
            throw new BusinessException('Wrong password');
        }

        return $token;
    }
}
