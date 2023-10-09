<?php

namespace App\UseCases\Admin\RoomFeature;

use Exception;
use App\Models\Image;
use App\Models\RoomFeature;
use Illuminate\Support\Facades\DB;
use App\Exceptions\DataBaseException;
use App\DTOs\MerchantFeature\StoreMerchantFeatureDTO;
use App\Repository\RoomFeatureRepository\RoomFeatureRepositoryInterface;

class RoomFeatureStoreUseCase
{
    public function __construct(
        private readonly RoomFeatureRepositoryInterface $roomFeatureRepository,
    ) {
    }

    /**
     * @throws DataBaseException
     */
    public function execute(StoreMerchantFeatureDTO $DTO): void
    {
        $roomFeature = new RoomFeature;
        $roomFeature->title_uz = $DTO->getTitleUz();
        $roomFeature->title_en = $DTO->getTitleEn();
        $roomFeature->title_ru = $DTO->getTitleRu();

        $path = 'merchantFeatureIcon';
        $imageName = random_int(1, 100000) . time() . '.' . $DTO->getIcon()->extension();
        $DTO->getIcon()->move($path, $imageName);
        $image = new Image;
        $image->image_path = $path . '/' . $imageName;
        $image->parent_image = true;

        try {
            DB::transaction(function () use ($roomFeature, $image) {
                $roomFeature = $this->roomFeatureRepository->save($roomFeature);
                $roomFeature->image()->save($image);
            });
        } catch (Exception $exception) {
            throw new DataBaseException;
        }
    }
}
