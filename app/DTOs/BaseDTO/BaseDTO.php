<?php

namespace App\DTOs\BaseDTO;

abstract class BaseDTO implements \JsonSerializable
{
    use ParseTrait;

    abstract public static function frommArray(array $data);

    protected function toTinn(float $money): int
    {
        return (int) ($money * 100);
    }
}
