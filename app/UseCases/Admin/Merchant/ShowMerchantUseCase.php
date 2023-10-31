<?php

namespace App\UseCases\Admin\Merchant;

use App\Http\Resources\MerchantDashboardResource\Merchant\MerchantDashboardResource;
use App\Models\Merchant\MerchantUser;
use App\Repository\MerchantUserRepository\MerchantUserRepositoryInterface;
use App\Tasks\Checker\CheckEntityTask;

class ShowMerchantUseCase {
    public function __construct(
        private readonly MerchantUserRepositoryInterface $userRepository,
        private readonly CheckEntityTask $checkEntityTask
    ) {
    }

    public function execute(int $id, MerchantUser $merchantUser): MerchantDashboardResource {
        $merchant = $this->userRepository->getUserMerchantById($id, $merchantUser);
        $this->checkEntityTask->run($merchant);

        return new MerchantDashboardResource($merchant);
    }
}
