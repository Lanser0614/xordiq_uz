<?php

namespace App\Enums\Order;

enum OrderStatusEnum {
    case NEW;
    case IN_PROCESSING;
    case CONFIRMED;
    case CANCELED;
}
