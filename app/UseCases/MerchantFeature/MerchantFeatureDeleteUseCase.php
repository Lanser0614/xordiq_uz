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

class MerchantFeatureDeleteUseCase
{
    public function __construct(
        private readonly MerchantFeatureRepositoryInterface $merchantFeatureRepository,
        private readonly CheckEntityTask $checkEntityTask
    )
    {
    }

    /**
     * @param int $id
     */
    public function execute(int $id): void
    {
        $merchantFeature = $this->merchantFeatureRepository->findById($id);
        $this->checkEntityTask->run($merchantFeature);
        $this->merchantFeatureRepository->delete($merchantFeature);
    }
}
