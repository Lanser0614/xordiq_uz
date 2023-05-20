<?php

namespace App\DTOs\MerchantUser;

use App\DTOs\BaseDTO\BaseDTO;
use App\Exceptions\DtoException\ParseException;

final class UserLoginDto extends BaseDTO
{
    public function __construct(
        private readonly int $phone,
        private readonly string $password
    ) {
    }

    public function getPhone(): int
    {
        return $this->phone;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return static
     *
     * @throws ParseException
     */
    public static function frommArray(array $data)
    {
        return new self(
            phone: self::parseInt(value: $data['phone']),
            password: self::parseString($data['password'])
        );
    }

    public function jsonSerialize(): array
    {
        return [];
    }
}
