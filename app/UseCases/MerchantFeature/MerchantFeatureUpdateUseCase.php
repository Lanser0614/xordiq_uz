<?php

namespace App\UseCases\MerchantFeature;

use App\DTOs\MerchantFeature\StoreMerchantFeatureDTO;
use App\Exceptions\DataBaseException;
use App\Models\Image;
use App\Models\MerchantFeature;
use App\Repository\MerchantFeatureRepository\MerchantFeatureRepositoryInterface;
use App\Tasks\Checker\CheckEntityTask;
use Exception;
use Illuminate\Support\Facades\DB;

class MerchantFeatureUpdateUseCase
{
    public function __construct(
        private readonly MerchantFeatureRepositoryInterface $merchantFeatureRepository,
        private readonly CheckEntityTask $checkEntityTask
    )
    {
    }

    /**
     * @param int $id
     * @param StoreMerchantFeatureDTO $DTO
     * @throws DataBaseException
     */
    public function execute(int $id, StoreMerchantFeatureDTO $DTO): void
    {
        $merchantFeature = $this->merchantFeatureRepository->findById($id);
        $this->checkEntityTask->run($merchantFeature);
        $merchantFeature->title_uz = $DTO->getTitleUz();
        $merchantFeature->title_en = $DTO->getTitleEn();
        $merchantFeature->title_ru = $DTO->getTitleRu();

        $path = 'merchantFeatureIcon';
        $imageName = random_int(1, 100000) . time() . '.' . $DTO->getIcon()->extension();
        $DTO->getIcon()->move($path, $imageName);
        $image = new Image();
        $image->image_path = $path . '/' . $imageName;
        $image->parent_image = true;

        try {
            DB::transaction(function () use ($merchantFeature, $image) {
                $merchantFeature = $this->merchantFeatureRepository->save($merchantFeature);
                $merchantFeature->image()->save($image);
            });
        } catch (Exception $exception) {
            throw new DataBaseException();
        }
    }
}
