<?php

namespace App\Enums\Ability;

enum AbilityEnum: string {
    case CAN_UPDATE_MERCHANT = 'CAN_UPDATE_MERCHANT';
    case CAN_SEE_MERCHANT = 'CAN_SEE_MERCHANT';
    case CAN_STORE_MERCHANT = 'CAN_STORE_MERCHANT';
    case CAN_DELETE_MERCHANT = 'CAN_DELETE_MERCHANT';
    case CAN_SET_CATEGORY_MERCHANT = 'CAN_SET_CATEGORY_MERCHANT';

    case CAN_SEE_FEATURE = 'CAN_SEE_FEATURE';

    case CAN_UPDATE_ROOM = 'CAN_UPDATE_ROOM';
    case CAN_SEE_ROOM = 'CAN_SEE_ROOM';
    case CAN_STORE_ROOM = 'CAN_STORE_ROOM';
    case CAN_DELETE_ROOM = 'CAN_DELETE_ROOM';

    public static function getAbilityAsArray(): array {
        return self::cases();
    }
}
