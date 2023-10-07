<?php

namespace App\UseCases\MerchantFeature;

use App\Tasks\Checker\CheckEntityTask;
use App\Repository\MerchantFeatureRepository\MerchantFeatureRepositoryInterface;

class MerchantFeatureDeleteUseCase
{
    public function __construct(
        private readonly MerchantFeatureRepositoryInterface $merchantFeatureRepository,
        private readonly CheckEntityTask $checkEntityTask
    ) {
    }

    public function execute(int $id): void
    {
        $merchantFeature = $this->merchantFeatureRepository->findById($id);
        $this->checkEntityTask->run($merchantFeature);
        $this->merchantFeatureRepository->delete($merchantFeature);
    }
}
