<?php

namespace App\UseCases\Admin\RoomFeature;

use App\Repository\RoomFeatureRepository\RoomFeatureRepositoryInterface;
use App\Tasks\Checker\CheckEntityTask;

class RoomFeatureDeleteUseCase {
    public function __construct(
        private readonly RoomFeatureRepositoryInterface $roomFeatureRepository,
        private readonly CheckEntityTask $checkEntityTask
    ) {
    }

    public function execute(int $id): void {
        $merchantFeature = $this->roomFeatureRepository->findById($id);
        $this->checkEntityTask->run($merchantFeature);
        $this->roomFeatureRepository->delete($merchantFeature);
    }
}
