<?php

namespace App\UseCases\Admin\Merchant;

use App\DTOs\MerchantDTOs\Merchant\StoreMerchantDTO;
use App\Enums\MerchantUser\MerchantUserRolesEnum;
use App\Exceptions\DataBaseException;
use App\Models\Media\Image;
use App\Models\Merchant\Merchant;
use App\Models\Merchant\MerchantOfUser;
use App\Models\Merchant\MerchantUser;
use App\Models\RBAC\Ability;
use App\Repository\MerchantRepository\MerchantRepositoryInterface;
use App\Tasks\Merchant\SaveMerchantPhotosTask;
use App\UseCases\BaseUseCase;
use Illuminate\Support\Facades\DB;

class StoreMerchantUseCase extends BaseUseCase {
    protected const PERMISSION_NAME = 'CAN_STORE_MERCHANT';

    public function __construct(
        private readonly MerchantRepositoryInterface $merchantRepository,
        private readonly SaveMerchantPhotosTask $saveMerchantPhotosTask
    ) {
    }

    /**
     * @throws DataBaseException
     */
    public function execute(MerchantUser $merchantUser, StoreMerchantDTO $DTO): void {
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
        $merchant->book_commission = $DTO->getBookCommisison();
        DB::transaction(function () use ($merchant, $DTO, $merchantUser) {
            $merchant = $this->merchantRepository->save($merchant);

            $this->saveMerchantRelationObject($merchant, $DTO, $merchantUser);

            //            $merchantOfUser = MerchantOfUser::query()
            //                ->where('merchant_user_id', '=', $merchantUser->id)
            //                ->where('merchant_id', $merchant->id)
            //                ->first();

            //            dd($merchantUser->id,
            //$merchant->id,);
            //            $merchantOfUser->merchantOfUserAbilities()->attach(Ability::query()->pluck('id')->toArray());

            $path = $merchant->id.'-merchant';
            $imageName = random_int(1, 100000).time().'.'.$DTO->getHomePhoto()->extension();
            $DTO->getHomePhoto()->move(storage_path('app/public/'.$path), $imageName);
            $image = new Image;
            $image->image_path = $path.'/'.$imageName;
            $image->parent_image = true;
            $merchant->images()->save($image);

            $this->saveMerchantPhotosTask->run($DTO->getPhotos(), $path, $merchant);
        });

        //        try {
        //        } catch (Exception $exception) {
        //            throw new DataBaseException;
        //        }
    }

    public function saveMerchantRelationObject(Merchant $merchant, StoreMerchantDTO $DTO, MerchantUser $merchantUser): void {
        $this->merchantRepository->saveMerchantCategory($merchant, $DTO->getCategoryIds());
        if ($DTO->getMerchantFeaturesIds() != null) {
            $this->merchantRepository->saveMerchantFeatures($merchant, $DTO->getMerchantFeaturesIds());
        }
        $this->merchantRepository->saveMerchantUser($merchant, MerchantUserRolesEnum::OWNER(), $merchantUser);

        /** @var MerchantOfUser $merchantOfUser */
        $merchantOfUser = MerchantOfUser::query()
            ->where('merchant_user_id', '=', $merchantUser->id)
            ->where('merchant_id', $merchant->id)
            ->first();

        $merchantOfUser->merchantOfUserAbilities()->attach(Ability::query()->pluck('id')->toArray());
    }
}
