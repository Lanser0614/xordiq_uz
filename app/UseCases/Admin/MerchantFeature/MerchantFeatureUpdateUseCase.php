<?php

namespace App\UseCases\Admin\MerchantFeature;

use Exception;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use App\Exceptions\DataBaseException;
use App\Tasks\Checker\CheckEntityTask;
use App\DTOs\MerchantFeature\StoreMerchantFeatureDTO;
use App\Repository\MerchantFeatureRepository\MerchantFeatureRepositoryInterface;

class MerchantFeatureUpdateUseCase
{
    public function __construct(
        private readonly MerchantFeatureRepositoryInterface $merchantFeatureRepository,
        private readonly CheckEntityTask $checkEntityTask
    ) {
    }

    /**
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
        $image = new Image;
        $image->image_path = $path . '/' . $imageName;
        $image->parent_image = true;

        try {
            DB::transaction(function () use ($merchantFeature, $image) {
                $merchantFeature = $this->merchantFeatureRepository->save($merchantFeature);
                $merchantFeature->image()->save($image);
            });
        } catch (Exception $exception) {
            throw new DataBaseException;
        }
    }
}
