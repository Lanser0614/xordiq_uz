<?php

namespace App\UseCases;

use App\Exceptions\DataBaseException;
use App\Enums\ExceptionEnum\ExceptionEnum;
use App\Enums\MerchantUser\MerchantUserRolesEnum;

class BaseUseCase
{
    protected const PERMISSION_NAME = '';

    final public function getPermissionName(): string
    {
        return static::PERMISSION_NAME;
    }

    /**
     * @throws DataBaseException
     */
    final protected function checkPermission(string $permission_name, string $role): void
    {
        if ($permission_name !== '' && $role !== MerchantUserRolesEnum::SUPER_ADMIN) {
            if (array_key_exists($role, self::$permission_array)) {
                $roles = self::$permission_array[$role];
                if (in_array($permission_name, $roles) === false) {
                    throw new DataBaseException(ExceptionEnum::NOT_ENOUGH_PERMISSION->name, 500);
                }
            }
        }
    }

    protected static array $permission_array = [
        MerchantUserRolesEnum::USER => [

        ],
        MerchantUserRolesEnum::ADMIN => [
            'CAN_UPDATE_MERCHANT',
            'CAN_DELETE_MERCHANT',
            'CAN_STORE_MERCHANT',
            'CAN_ADD_USER',
            'CAN_STORE_ROOM',
        ],
        MerchantUserRolesEnum::SUPER_ADMIN => [

        ],
        MerchantUserRolesEnum::OPERATOR => [

        ],
    ];
}
