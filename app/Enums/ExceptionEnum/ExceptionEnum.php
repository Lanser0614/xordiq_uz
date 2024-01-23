<?php

namespace App\Enums\ExceptionEnum;

enum ExceptionEnum: int {
    case ENTITY_NOT_FOUND = 404;

    case NOT_ENOUGH_PERMISSION = 403;
}
