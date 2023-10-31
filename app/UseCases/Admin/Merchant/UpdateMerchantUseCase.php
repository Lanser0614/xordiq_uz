<?php

namespace App\UseCases\Admin\Merchant;

use App\DTOs\Merchant\UpdateMerchantDTO;
use App\Exceptions\DataBaseException;
use App\Models\Image;
use App\Models\Merchant\Merchant;
use App\Models\Merchant\MerchantUser;
use App\Repository\MerchantRepository\MerchantRepositoryInterface;
use App\Repository\MerchantUserRepository\MerchantUserRepositoryInterface;
use App\Tasks\Checker\CheckEntityTask;
use App\Tasks\Merchant\SaveMerchantPhotosTask;
use App\UseCases\BaseUseCase;
use Exception;
use Illuminate\Support\Facades\DB;

class UpdateMerchantUseCase extends BaseUseCase {
    protected const PERMISSION_NAME = 'CAN_UPDATE_MERCHANT';

    public function __construct(
        private readonly MerchantUserRepositoryInterface $userRepository,
        private readonly MerchantRepositoryInterface $merchantRepository,
        private readonly CheckEntityTask $checkEntityTask,
        private readonly SaveMerchantPhotosTask $saveMerchantPhotosTask
    ) {
    }

    /**
     * @throws DataBaseException
     */
    public function execute(int $id, MerchantUser $merchantUser, UpdateMerchantDTO $DTO): void {
        $this->checkPermission($this->getPermissionName(), $merchantUser->role);
        /** @var Merchant $merchant */
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
        $merchant->village_id = $DTO->getVillageId();
        $merchant->district_id = $DTO->getDistrictId();
        $merchant->latitude = $DTO->getLatitude();
        $merchant->book_commisison = $DTO->getBookCommisison();
        try {
            DB::transaction(function () use ($merchant, $DTO) {
                $merchant = $this->merchantRepository->save($merchant);
                $merchant->merchantsUser()->sync($merchant);
                $path = public_path($merchant->id.'-merchant');
                $imageName = random_int(1, 100000).time().'.'.$DTO->getHomePhoto()->extension();
                $DTO->getHomePhoto()->move($path, $imageName);
                $image = new Image;
                $image->image_path = $path.'/'.$imageName;
                $image->parent_image = true;
                $merchant->images()->save($image);

                $this->saveMerchantPhotosTask->run($DTO->getPhotos(), $path, $merchant);
            });
        } catch (Exception $exception) {
            throw new DataBaseException;
        }
    }
}
