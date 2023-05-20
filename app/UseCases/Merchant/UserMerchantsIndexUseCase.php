<?php

namespace App\UseCases\Merchant;

use App\Models\MerchantUser;
use App\Repository\MerchantRepository\MerchantRepositoryInterface;
use App\Repository\MerchantUserRepository\UserRepositoryInterface;
use App\Tasks\Checker\CheckEntityTask;

class UserMerchantsIndexUseCase
{
    /**
     * @param UserRepositoryInterface $userRepository
     * @param MerchantRepositoryInterface $merchantRepository
     * @param CheckEntityTask $checkEntityTask
     */
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
    )
    {
    }
    public function execute(MerchantUser $merchantUser, int $perPage = 15, int $page = 1)
    {
       return $this->userRepository->getUserMerchants($merchantUser, $perPage, $page);
    }
}
