<?php

namespace App\UseCases\Merchant;

use App\DTOs\Merchant\StoreMerchantDTO;
use App\DTOs\Merchant\UpdateMerchantDTO;
use App\Exceptions\DataBaseException;
use App\Models\Merchant;
use App\Models\MerchantUser;
use App\Repository\MerchantRepository\MerchantRepositoryInterface;
use App\Repository\MerchantUserRepository\UserRepositoryInterface;
use App\Tasks\Checker\CheckEntityTask;
use App\UseCases\BaseUseCase;
use Illuminate\Support\Facades\DB;

class DeleteMerchantUseCase extends BaseUseCase
{
    protected const  PERMISSION_NAME = "CAN_DELETE_MERCHANT";
    /**
     * @param UserRepositoryInterface $userRepository
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

    /**
     * @param int $id
     * @param MerchantUser $merchantUser
     * @throws DataBaseException
     */
    public function execute(int $id, MerchantUser $merchantUser): void
    {
        $this->checkPermission($this->getPermissionName(), $merchantUser->role);
        $merchant = $this->userRepository->getUserMerchantById($id, $merchantUser);
        $this->checkEntityTask->run($merchant);
        DB::transaction(function () use ($id, $merchantUser){
            $this->merchantRepository->delete($id);
            $this->userRepository->deleteMerchantFromUser($merchantUser, $id);
        });
    }
}