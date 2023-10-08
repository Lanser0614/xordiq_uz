<?php

namespace App\UseCases\Admin\MerchantFeature;

use App\Repository\MerchantFeatureRepository\MerchantFeatureRepositoryInterface;
use App\Tasks\Checker\CheckEntityTask;

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
