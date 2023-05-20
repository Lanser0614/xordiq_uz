<?php

namespace App\UseCases\Merchant;

use App\Models\MerchantUser;
use App\Repository\MerchantUserRepository\UserRepositoryInterface;
use App\Tasks\Checker\CheckEntityTask;

class ShowMerchantUseCase
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly CheckEntityTask $checkEntityTask
    ) {
    }

    public function execute(int $id, MerchantUser $merchantUser)
    {
        $merchant = $this->userRepository->getUserMerchantById($id, $merchantUser);
        $this->checkEntityTask->run($merchant);

        return $merchant;
    }
}
