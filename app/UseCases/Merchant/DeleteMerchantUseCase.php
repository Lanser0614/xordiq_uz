<?php

namespace App\UseCases\Merchant;

use App\DTOs\Merchant\StoreMerchantDTO;
use App\DTOs\Merchant\UpdateMerchantDTO;
use App\Models\Merchant;
use App\Models\MerchantUser;
use App\Repository\MerchantRepository\MerchantRepositoryInterface;
use App\Repository\MerchantUserRepository\UserRepositoryInterface;
use App\Tasks\Checker\CheckEntityTask;
use Illuminate\Support\Facades\DB;

class DeleteMerchantUseCase
{
    /**
     * @param MerchantRepositoryInterface $merchantRepository
     * @param CheckEntityTask $checkEntityTask
     */
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly MerchantRepositoryInterface $merchantRepository,
        private readonly CheckEntityTask $checkEntityTask
    )
    {
    }

    public function execute(int $id, MerchantUser $merchantUser): void
    {
        $merchant = $this->userRepository->getUserMerchantById($id, $merchantUser);
        $this->checkEntityTask->run($merchant);
        DB::transaction(function () use ($id){
            $this->merchantRepository->delete($id);
        });
    }
}
