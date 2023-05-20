<?php

namespace App\Enums\MerchantUser;

use MyCLabs\Enum\Enum;

class MerchantUserRolesEnum extends Enum
{
    public const OPERATOR = 'OPERATOR';

    public const ADMIN = 'ADMIN';

    public const SUPER_ADMIN = 'SUPER_ADMIN';

    public const USER = 'USER';
}
