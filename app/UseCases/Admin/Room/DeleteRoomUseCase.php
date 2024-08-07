<?php

namespace App\UseCases\Admin\Room;

use App\Models\Merchant\MerchantUser;
use App\Repository\MerchantUserRepository\MerchantUserRepositoryInterface;
use App\Repository\RoomRepository\RoomRepositoryInterface;
use App\Tasks\Checker\CheckEntityTask;
use App\UseCases\BaseUseCase;

class DeleteRoomUseCase extends BaseUseCase {
    public function __construct(
        private readonly RoomRepositoryInterface $roomRepository,
        private readonly MerchantUserRepositoryInterface $userRepository,
        private readonly CheckEntityTask $checkEntityTask
    ) {
    }

    public function execute(int $merchantId, int $romId, MerchantUser $merchantUser): void {
        $merchant = $this->userRepository->getUserMerchantById($merchantId, $merchantUser);
        $this->checkEntityTask->run($merchant);
        $room = $this->roomRepository->getByRoomId($romId);
        $this->checkEntityTask->run($room);
        $this->roomRepository->delete($room);
    }
}
