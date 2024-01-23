<?php

namespace App\UseCases\Admin\Merchant;

use App\Http\Resources\MerchantDashboardResource\Merchant\MerchantDashboardResource;
use App\Models\Merchant\MerchantUser;
use App\Repository\MerchantUserRepository\MerchantUserRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserMerchantsIndexUseCase {
    public function __construct(
        private readonly MerchantUserRepositoryInterface $userRepository,
    ) {
    }

    public function execute(
        MerchantUser $merchantUser,
        int $perPage = 15, int $page = 1
    ): AnonymousResourceCollection {
        $merchants = $this->userRepository->getUserMerchants($merchantUser, $perPage, $page, ['village','district','images', 'rooms', 'merchantsCategories']);

        return MerchantDashboardResource::collection($merchants);
    }
}
