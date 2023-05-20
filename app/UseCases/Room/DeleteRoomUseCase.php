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

class DeleteRoomUseCase extends BaseUseCase
{
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
     * @param int $merchantId
     * @param int $romId
     * @param MerchantUser $merchantUser
     */
    public function execute(int $merchantId, int $romId, MerchantUser $merchantUser): void
    {
        $merchant = $this->userRepository->getUserMerchantById($merchantId, $merchantUser);
        $this->checkEntityTask->run($merchant);
        $room = $this->roomRepository->getByRoomId($romId);
        $this->checkEntityTask->run($room);
        $this->roomRepository->delete($room);
    }
}
