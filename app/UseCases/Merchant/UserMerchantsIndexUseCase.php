<?php

namespace App\UseCases\Merchant;

use App\Models\MerchantUser;
use App\Repository\MerchantUserRepository\UserRepositoryInterface;

class UserMerchantsIndexUseCase
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
    ) {
    }

    public function execute(MerchantUser $merchantUser, int $perPage = 15, int $page = 1)
    {
        return $this->userRepository->getUserMerchants($merchantUser, $perPage, $page);
    }
}
