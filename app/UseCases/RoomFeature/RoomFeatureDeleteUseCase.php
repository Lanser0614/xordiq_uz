<?php

namespace App\UseCases\RoomFeature;

use App\DTOs\MerchantFeature\StoreMerchantFeatureDTO;
use App\Exceptions\DataBaseException;
use App\Models\Image;
use App\Models\MerchantFeature;
use App\Repository\MerchantFeatureRepository\MerchantFeatureRepositoryInterface;
use App\Repository\RoomFeatureRepository\RoomFeatureRepositoryInterface;
use App\Tasks\Checker\CheckEntityTask;
use Exception;
use Illuminate\Support\Facades\DB;

class RoomFeatureDeleteUseCase
{
    public function __construct(
        private readonly RoomFeatureRepositoryInterface $roomFeatureRepository,
        private readonly CheckEntityTask                $checkEntityTask
    )
    {
    }

    /**
     * @param int $id
     */
    public function execute(int $id): void
    {
        $merchantFeature = $this->roomFeatureRepository->findById($id);
        $this->checkEntityTask->run($merchantFeature);
        $this->roomFeatureRepository->delete($merchantFeature);
    }
}
