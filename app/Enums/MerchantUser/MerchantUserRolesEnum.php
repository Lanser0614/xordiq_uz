<?php

namespace App\Enums\MerchantUser;

enum MerchantUserRolesEnum
{
    case OPERATOR;
    case ADMIN;
    case SUPER_ADMIN;
    case USER;
}
