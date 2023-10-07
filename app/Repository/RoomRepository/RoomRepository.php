<?php

namespace App\Repository\RoomRepository;

use App\Models\Room;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class RoomRepository implements RoomRepositoryInterface
{
    public function save(Room $model): Room
    {
        $model->save();

        return $model;
    }

    public function getByRoomId(int $id): Model|Collection|Builder|array|null
    {
        return Room::query()->find($id);
    }

    public function delete(Room $model): void
    {
        $model->delete();
    }
}
