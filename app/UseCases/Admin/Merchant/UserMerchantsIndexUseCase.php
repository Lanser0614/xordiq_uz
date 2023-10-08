<?php

namespace App\UseCases\Admin\Merchant;

use App\Models\MerchantUser;
use App\Repository\MerchantUserRepository\MerchantUserRepositoryInterface;

class UserMerchantsIndexUseCase
{
    public function __construct(
        private readonly MerchantUserRepositoryInterface $userRepository,
    ) {
    }

    public function execute(
        MerchantUser $merchantUser,
        int $perPage = 15, int $page = 1
    ) {
        return $this->userRepository->getUserMerchants($merchantUser, $perPage, $page);
    }
}
