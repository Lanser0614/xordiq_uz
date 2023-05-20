<?php

namespace App\UseCases\Merchant;

use App\DTOs\Merchant\UpdateMerchantDTO;
use App\Exceptions\DataBaseException;
use App\Models\MerchantUser;
use App\Repository\MerchantRepository\MerchantRepositoryInterface;
use App\Repository\MerchantUserRepository\UserRepositoryInterface;
use App\Tasks\Checker\CheckEntityTask;
use App\UseCases\BaseUseCase;
use Exception;
use Illuminate\Support\Facades\DB;

class UpdateMerchantUseCase extends BaseUseCase
{
    protected const PERMISSION_NAME = 'CAN_UPDATE_MERCHANT';

    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly MerchantRepositoryInterface $merchantRepository,
        private readonly CheckEntityTask $checkEntityTask
    ) {
    }

    /**
     * @throws DataBaseException
     */
    public function execute(int $id, MerchantUser $merchantUser, UpdateMerchantDTO $DTO): void
    {
        $this->checkPermission($this->getPermissionName(), $merchantUser->role);
        $merchant = $this->userRepository->getUserMerchantById($id, $merchantUser);
        $this->checkEntityTask->run($merchant);
        $merchant->title_en = $DTO->getTitleEn();
        $merchant->title_ru = $DTO->getTitleRu();
        $merchant->title_uz = $DTO->getTitleUz();
        $merchant->description_en = $DTO->getDescriptionEn();
        $merchant->description_ru = $DTO->getDescriptionRu();
        $merchant->description_uz = $DTO->getDescriptionUz();
        $merchant->longitude = $DTO->getLongitude();
        $merchant->latitude = $DTO->getLatitude();
        $merchant->book_commisison = $DTO->getBookCommisison();
        try {
            DB::transaction(function () use ($merchant, $merchantUser) {
                $merchant = $this->merchantRepository->save($merchant);
                $merchant->merchantsUser()->attach($merchantUser->id);
            });
        } catch (Exception $e) {
            throw new DataBaseException('Merchant not updated');
        }

    }
}
