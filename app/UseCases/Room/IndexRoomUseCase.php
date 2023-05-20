<?php

namespace App\UseCases\Room;

use App\DTOs\Room\StoreRoomDTO;
use App\Exceptions\DataBaseException;
use App\Models\Image;
use App\Models\MerchantUser;
use App\Models\Room;
use App\Repository\MerchantRepository\MerchantRepositoryInterface;
use App\Repository\MerchantUserRepository\UserRepositoryInterface;
use App\Repository\RoomRepository\RoomRepositoryInterface;
use App\Tasks\Checker\CheckEntityTask;
use App\UseCases\BaseUseCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class IndexRoomUseCase extends BaseUseCase
{

    public function __construct(
        private readonly MerchantRepositoryInterface  $merchantRepository,
        private readonly CheckEntityTask $checkEntityTask
    )
    {
    }

    /**
     * @param int $merchantId
     * @param MerchantUser $merchantUser
     */
    public function execute(int $merchantId, MerchantUser $merchantUser)
    {
       $merchantRooms = $this->merchantRepository->getMerchantRooms($merchantId, $merchantUser);
       $this->checkEntityTask->run($merchantRooms);
       return $merchantRooms;
    }
}
