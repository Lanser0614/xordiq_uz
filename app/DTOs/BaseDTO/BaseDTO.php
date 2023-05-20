<?php

namespace App\DTOs\BaseDTO;

use Alifuz\Utils\Entities\AbstractEntity;
use App\Exceptions\DtoException\ParseException;
use Carbon\Carbon;
use Exception;

abstract class BaseDTO implements \JsonSerializable
{
    use ParseTrait;
    public abstract static function frommArray(array $data);



}
