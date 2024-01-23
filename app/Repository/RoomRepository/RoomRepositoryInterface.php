<?php

namespace App\Repository\RoomRepository;

use App\Models\Merchant\Room;

interface RoomRepositoryInterface {
    public function save(Room $model): Room;

    public function getByRoomId(int $id);

    public function delete(Room $model);
}
