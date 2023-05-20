<?php

namespace App\UseCases\Room;

use App\DTOs\Room\StoreRoomDTO;
use App\Exceptions\DataBaseException;
use App\Models\Image;
use App\Models\MerchantUser;
use App\Models\Room;
use App\Repository\MerchantUserRepository\UserRepositoryInterface;
use App\Repository\RoomRepository\RoomRepositoryInterface;
use App\Tasks\Checker\CheckEntityTask;
use App\UseCases\BaseUseCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StoreRoomUseCase extends BaseUseCase
{
    public const PERMISSION_NAME = "CAN_STORE_ROOM";

    /**
     * @param RoomRepositoryInterface $roomRepository
     * @param UserRepositoryInterface $userRepository
     * @param CheckEntityTask $checkEntityTask
     */
    public function __construct(
        private readonly RoomRepositoryInterface $roomRepository,
        private readonly UserRepositoryInterface $userRepository,
        private readonly CheckEntityTask         $checkEntityTask
    )
    {
    }

    /**
     * @throws DataBaseException
     */
    public function execute(int $merchantId, StoreRoomDTO $DTO, MerchantUser $merchantUser): void
    {
        $this->checkPermission($this->getPermissionName(), $merchantUser->role);
        $merchant = $this->userRepository->getUserMerchantById($merchantId, $merchantUser);
        $this->checkEntityTask->run($merchant);
        $room = new Room();
        $room->title_en = $DTO->getTitleEn();
        $room->title_uz = $DTO->getTitleUz();
        $room->title_ru = $DTO->getTitleRu();
        $room->price = $DTO->getPrice();
        $room->merchant_id = $merchantId;

        DB::transaction(function () use ($room, $merchantId, $DTO){
            $room = $this->roomRepository->save($room);
            $path = $merchantId . "-merchant/roomPhotos";
            Storage::put("{$path}", $DTO->getHomePhoto());
            $image = new Image();
            $image->image_path = $path;
            $image->parent_image = true;
            $room->images()->save($image);

            $this->savePhotos($DTO, $path, $room);
        });
    }

    /**
     * @param StoreRoomDTO $DTO
     * @param string $path
     * @param $room
     * @return void
     */
    function savePhotos(StoreRoomDTO $DTO, string $path, $room): void
    {
        foreach ($DTO->getPhotos() as $photo) {
            Storage::put("{$path}", $photo);
            $image = new Image();
            $image->image_path = $path;
            $room->images()->save($image);
        }
    }
}
