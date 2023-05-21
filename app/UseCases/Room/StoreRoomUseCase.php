<?php

namespace App\UseCases\Room;

use App\DTOs\Room\StoreRoomDTO;
use App\Exceptions\DataBaseException;
use App\Models\Image;
use App\Models\MerchantUser;
use App\Models\Room;
use App\Repository\MerchantUserRepository\MerchantUserRepositoryInterface;
use App\Repository\RoomRepository\RoomRepositoryInterface;
use App\Tasks\Checker\CheckEntityTask;
use App\UseCases\BaseUseCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class StoreRoomUseCase extends BaseUseCase
{
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

        DB::transaction(function () use ($room, $merchantId, $DTO) {
            $room = $this->roomRepository->save($room);
            $path = $merchantId.'-merchant/rooms/'.$room->id;
            $imageName = random_int(1, 100000).time().'.'.$DTO->getHomePhoto()->extension();
            $DTO->getHomePhoto()->move($path, $imageName);
            $image = new Image();
            $image->image_path = $path.'/'.$imageName;
            $image->parent_image = true;
            $room->images()->save($image);

            $this->savePhotos($DTO, $path, $room);
        });
    }

    /**
     * @throws \Exception
     */
    public function savePhotos(StoreRoomDTO $DTO, string $path, $room): void
    {
        foreach ($DTO->getPhotos() as $photo) {
            /** @var UploadedFile $photo */
            $imageName = random_int(1, 100000).time().'.'.$photo->extension();
            $photo->move($path, $imageName);
            $image = new Image();
            $image->image_path = $path.'/'.$imageName;
            $room->images()->save($image);
        }
    }
}
