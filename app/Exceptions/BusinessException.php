<?php

declare(strict_types=1);

namespace App\Exceptions;

class BusinessException extends \Exception {
    protected $message = 'Business Logic error';

    protected $code = 500;
}
