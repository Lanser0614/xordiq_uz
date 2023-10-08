<?php

namespace App\UseCases\Admin\Room;

use App\Models\MerchantUser;
use App\Repository\MerchantRepository\MerchantRepositoryInterface;
use App\Tasks\Checker\CheckEntityTask;
use App\UseCases\BaseUseCase;

class IndexRoomUseCase extends BaseUseCase
{
    public function __construct(
        private readonly MerchantRepositoryInterface $merchantRepository,
        private readonly CheckEntityTask $checkEntityTask
    ) {
    }

    public function execute(int $merchantId, MerchantUser $merchantUser)
    {
        $merchantRooms = $this->merchantRepository->getMerchantRooms($merchantId, $merchantUser);
        $this->checkEntityTask->run($merchantRooms);

        return $merchantRooms;
    }
}
