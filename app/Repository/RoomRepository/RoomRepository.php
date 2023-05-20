<?php

namespace App\Repository\RoomRepository;

use App\Models\Room;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class RoomRepository implements RoomRepositoryInterface
{

    public function save(Room $model)
    {
       $model->save();
       return $model;
    }

    public function getByRoomId(int $id): Model|Collection|Builder|array|null
    {
       return Room::query()->find($id);
    }
}
