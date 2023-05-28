<?php

namespace App\Repository\RoomFeatureRepository;

use App\Models\RoomFeature;

class RoomFeatureRepository implements RoomFeatureRepositoryInterface
{

    public function findById(int $id): ?RoomFeature
    {
       return RoomFeature::query()->find($id);
    }

    public function save(RoomFeature $roomFeature): RoomFeature
    {
        $roomFeature->save();
        return $roomFeature;
    }

    public function delete(RoomFeature $roomFeature)
    {
        $roomFeature->delete();
    }
}
