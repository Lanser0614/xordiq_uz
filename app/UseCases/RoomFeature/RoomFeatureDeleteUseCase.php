<?php

namespace App\UseCases\RoomFeature;

use App\Tasks\Checker\CheckEntityTask;
use App\Repository\RoomFeatureRepository\RoomFeatureRepositoryInterface;

class RoomFeatureDeleteUseCase
{
    public function __construct(
        private readonly RoomFeatureRepositoryInterface $roomFeatureRepository,
        private readonly CheckEntityTask $checkEntityTask
    ) {
    }

    public function execute(int $id): void
    {
        $merchantFeature = $this->roomFeatureRepository->findById($id);
        $this->checkEntityTask->run($merchantFeature);
        $this->roomFeatureRepository->delete($merchantFeature);
    }
}
