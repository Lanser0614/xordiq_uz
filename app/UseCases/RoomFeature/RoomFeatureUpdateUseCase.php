<?php

namespace App\UseCases\RoomFeature;

use Exception;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use App\Exceptions\DataBaseException;
use App\Tasks\Checker\CheckEntityTask;
use App\DTOs\MerchantFeature\StoreMerchantFeatureDTO;
use App\Repository\RoomFeatureRepository\RoomFeatureRepositoryInterface;

class RoomFeatureUpdateUseCase
{
    public function __construct(
        private readonly RoomFeatureRepositoryInterface $roomFeatureRepository,
        private readonly CheckEntityTask $checkEntityTask
    ) {
    }

    /**
     * @throws DataBaseException
     * @throws Exception
     */
    public function execute(int $id, StoreMerchantFeatureDTO $DTO): void
    {
        $merchantFeature = $this->roomFeatureRepository->findById($id);
        $this->checkEntityTask->run($merchantFeature);
        $merchantFeature->title_uz = $DTO->getTitleUz();
        $merchantFeature->title_en = $DTO->getTitleEn();
        $merchantFeature->title_ru = $DTO->getTitleRu();

        $path = 'merchantFeatureIcon';
        $imageName = random_int(1, 100000) . time() . '.' . $DTO->getIcon()->extension();
        $DTO->getIcon()->move($path, $imageName);
        $image = new Image;
        $image->image_path = $path . '/' . $imageName;
        $image->parent_image = true;

        try {
            DB::transaction(function () use ($merchantFeature, $image) {
                $merchantFeature = $this->roomFeatureRepository->save($merchantFeature);
                $merchantFeature->image()->save($image);
            });
        } catch (Exception $exception) {
            throw new DataBaseException;
        }
    }
}
