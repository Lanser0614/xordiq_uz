<?php

namespace App\UseCases\Merchant;

use App\DTOs\Merchant\StoreMerchantDTO;
use App\Exceptions\DataBaseException;
use App\Models\Merchant;
use App\Models\MerchantUser;
use App\Repository\MerchantRepository\MerchantRepositoryInterface;
use App\UseCases\BaseUseCase;
use Illuminate\Support\Facades\DB;

class StoreMerchantUseCase extends BaseUseCase
{
    protected const  PERMISSION_NAME = "CAN_STORE_MERCHANT";

    /**
     * @param MerchantRepositoryInterface $merchantRepository
     */
    public function __construct(
        private readonly MerchantRepositoryInterface $merchantRepository
    )
    {
    }

    /**
     * @throws DataBaseException
     */
    public function execute(MerchantUser $merchantUser, StoreMerchantDTO $DTO): void
    {
        $this->checkPermission($this->getPermissionName(), $merchantUser->role);
        $merchant = new Merchant();
        $merchant->title_en = $DTO->getTitleEn();
        $merchant->title_ru = $DTO->getTitleRu();
        $merchant->title_uz = $DTO->getTitleUz();
        $merchant->description_en = $DTO->getDescriptionEn();
        $merchant->description_ru = $DTO->getDescriptionRu();
        $merchant->description_uz = $DTO->getDescriptionUz();
        $merchant->longitude = $DTO->getLongitude();
        $merchant->latitude = $DTO->getLatitude();
        $merchant->book_commisison = $DTO->getBookCommisison();
        DB::transaction(function () use ($merchant, $merchantUser){
            $merchant = $this->merchantRepository->save($merchant);
            $merchant->merchantsUser()->sync($merchant);
        });
    }
}
