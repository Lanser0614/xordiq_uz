<?php

namespace App\Repository\RoomFeatureRepository;

use App\Models\Merchant\RoomFeature;

interface RoomFeatureRepositoryInterface {
    public function findById(int $id): ?RoomFeature;

    public function save(RoomFeature $roomFeature): RoomFeature;

    public function delete(RoomFeature $roomFeature);
}
