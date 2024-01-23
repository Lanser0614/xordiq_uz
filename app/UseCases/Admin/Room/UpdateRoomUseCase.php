<?php

namespace App\UseCases\Admin\Room;

use App\DTOs\MerchantDTOs\Room\StoreRoomDTO;
use App\Exceptions\DataBaseException;
use App\Models\Media\Image;
use App\Models\Merchant\MerchantUser;
use App\Repository\MerchantUserRepository\MerchantUserRepositoryInterface;
use App\Repository\RoomRepository\RoomRepositoryInterface;
use App\Tasks\Checker\CheckEntityTask;
use App\UseCases\BaseUseCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UpdateRoomUseCase extends BaseUseCase {
    public const PERMISSION_NAME = 'CAN_STORE_ROOM';

    public function __construct(
        private readonly RoomRepositoryInterface $roomRepository,
        private readonly MerchantUserRepositoryInterface $userRepository,
        private readonly CheckEntityTask $checkEntityTask
    ) {
    }

    /**
     * @throws DataBaseException
     */
    public function execute(int $merchantId, int $romId, StoreRoomDTO $DTO, MerchantUser $merchantUser): void {
        $this->checkPermission($this->getPermissionName(), $merchantUser->role);
        $merchant = $this->userRepository->getUserMerchantById($merchantId, $merchantUser);
        $this->checkEntityTask->run($merchant);
        $room = $this->roomRepository->getByRoomId($romId);
        $this->checkEntityTask->run($room);

        $room->title_en = $DTO->getTitleEn();
        $room->title_uz = $DTO->getTitleUz();
        $room->title_ru = $DTO->getTitleRu();
        $room->price = $DTO->getPrice();
        $room->merchant_id = $merchantId;

        DB::transaction(function () use ($room, $merchantId, $DTO) {
            $room = $this->roomRepository->save($room);
            $path = $merchantId.'-merchant/roomPhotos';
            Storage::put("{$path}", $DTO->getHomePhoto());
            $image = new Image;
            $image->image_path = $path;
            $image->parent_image = true;
            $room->images()->save($image);

            $this->savePhotos($DTO, $path, $room);
        });
    }

    public function savePhotos(StoreRoomDTO $DTO, string $path, $room): void {
        foreach ($DTO->getPhotos() as $photo) {
            Storage::put("{$path}", $photo);
            $image = new Image;
            $image->image_path = $path;
            $room->images()->save($image);
        }
    }
}
