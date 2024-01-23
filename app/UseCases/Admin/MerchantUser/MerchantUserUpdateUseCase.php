<?php

namespace App\UseCases\Admin\MerchantUser;

use App\DTOs\MerchantDTOs\MerchantUser\MerchantUserUpdateDto;
use App\Exceptions\BusinessException;
use App\Repository\MerchantUserRepository\MerchantUserRepositoryInterface;
use App\Tasks\Checker\CheckEntityTask;
use Exception;
use Illuminate\Support\Facades\Hash;

class MerchantUserUpdateUseCase {
    public function __construct(
        private readonly MerchantUserRepositoryInterface $userRepository,
        private readonly CheckEntityTask $checkEntityTask
    ) {
    }

    /**
     * @throws Exception
     */
    public function execute(int $id, MerchantUserUpdateDto $dto): void {
        $merchantUser = $this->userRepository->getById($id);

        $this->checkEntityTask->run($merchantUser);

        if (Hash::check($dto->getOldPassword(), $merchantUser->password) === false) {
            throw new BusinessException('old password is wrong');
        }

        $merchantUser->name = $dto->getName();
        $merchantUser->email = $dto->getEmail();
        $merchantUser->phone = $dto->getPhone();
        $merchantUser->surname = $dto->getSurname();
        $merchantUser->password = Hash::make($dto->getPassword());

        $this->userRepository->save($merchantUser);
    }
}
