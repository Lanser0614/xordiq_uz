<?php

namespace App\Exceptions;

class DataBaseException extends \Exception {
    protected $message = 'Database error';

    protected $code = 500;
}
