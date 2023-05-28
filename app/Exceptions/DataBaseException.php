<?php

namespace App\Exceptions;

class DataBaseException extends \Exception
{
    protected $message = 'Application Logic error';

    protected $code = 500;
}
