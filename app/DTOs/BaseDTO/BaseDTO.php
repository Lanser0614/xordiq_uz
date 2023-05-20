<?php

namespace App\DTOs\BaseDTO;

abstract class BaseDTO implements \JsonSerializable
{
    use ParseTrait;

    abstract public static function frommArray(array $data);
}
