<?php

namespace App\Repository\RoomRepository;

use App\Models\Room;

interface RoomRepositoryInterface
{
    public function save(Room $model);

    public function getByRoomId(int $id);
}
