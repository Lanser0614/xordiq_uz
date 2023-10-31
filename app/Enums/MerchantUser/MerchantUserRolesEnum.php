<?php

namespace App\Enums\MerchantUser;

use MyCLabs\Enum\Enum;

/**
 * @method static self OWNER()
 * @method static self OPERATOR()
 * @method static self ADMIN()
 * @method static self SUPER_ADMIN()
 */
class MerchantUserRolesEnum extends Enum {
    public const OPERATOR = 'OPERATOR';

    public const ADMIN = 'ADMIN';

    public const SUPER_ADMIN = 'SUPER_ADMIN';

    public const OWNER = 'OWNER';
}
