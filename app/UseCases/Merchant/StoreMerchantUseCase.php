<?php

namespace App\UseCases\Merchant;

use Exception;
use App\Models\Image;
use App\Models\Merchant;
use App\Models\MerchantUser;
use App\UseCases\BaseUseCase;
use Illuminate\Support\Facades\DB;
use App\Exceptions\DataBaseException;
use App\DTOs\Merchant\StoreMerchantDTO;
use App\Tasks\Merchant\SaveMerchantPhotosTask;
use App\Repository\MerchantRepository\MerchantRepositoryInterface;

class StoreMerchantUseCase extends BaseUseCase
{
    protected const PERMISSION_NAME = 'CAN_STORE_MERCHANT';

    public function __construct(
        private readonly MerchantRepositoryInterface $merchantRepository,
        private readonly SaveMerchantPhotosTask $saveMerchantPhotosTask
    ) {
    }

    /**
     * @throws DataBaseException
     */
    public function execute(MerchantUser $merchantUser, StoreMerchantDTO $DTO): void
    {
        $this->checkPermission($this->getPermissionName(), $merchantUser->role);
        $merchant = new Merchant;
        $merchant->title_en = $DTO->getTitleEn();
        $merchant->title_ru = $DTO->getTitleRu();
        $merchant->title_uz = $DTO->getTitleUz();
        $merchant->description_en = $DTO->getDescriptionEn();
        $merchant->description_ru = $DTO->getDescriptionRu();
        $merchant->description_uz = $DTO->getDescriptionUz();
        $merchant->longitude = $DTO->getLongitude();
        $merchant->latitude = $DTO->getLatitude();
        $merchant->village_id = $DTO->getVillageId();
        $merchant->district_id = $DTO->getDistrictId();
        $merchant->book_commisison = $DTO->getBookCommisison();
        DB::transaction(function () use ($merchant, $DTO) {
            $merchant = $this->merchantRepository->save($merchant);

            $this->saveMerchantRelationObject($merchant, $DTO);

            $path = $merchant->id . '-merchant';
            $imageName = random_int(1, 100000) . time() . '.' . $DTO->getHomePhoto()->extension();
            $DTO->getHomePhoto()->move($path, $imageName);
            $image = new Image;
            $image->image_path = $path . '/' . $imageName;
            $image->parent_image = true;
            $merchant->images()->save($image);

            $this->saveMerchantPhotosTask->run($DTO->getPhotos(), $path, $merchant);
        });

//        try {
//        } catch (Exception $exception) {
//            throw new DataBaseException;
//        }
    }

    public function saveMerchantRelationObject(Merchant $merchant, StoreMerchantDTO $DTO): void
    {
        $this->merchantRepository->saveMerchantCategory($merchant, $DTO->getCategoryIds());
        if ($DTO->getMerchantFeaturesIds() != null) {
            $this->merchantRepository->saveMerchantFeatures($merchant, $DTO->getMerchantFeaturesIds());
        }
        $this->merchantRepository->saveMerchantUser($merchant);
    }
}
