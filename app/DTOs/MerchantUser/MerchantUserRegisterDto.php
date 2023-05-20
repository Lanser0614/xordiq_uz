<?php

namespace App\DTOs\MerchantUser;

use App\DTOs\BaseDTO\BaseDTO;
use App\Exceptions\DtoException\ParseException;

class MerchantUserRegisterDto extends BaseDTO
{
    public function __construct(
        private readonly int     $phone,
        private readonly ?string $email,
        private readonly string  $name,
        private readonly string  $surname,
        private readonly string     $password,
    )
    {
    }

    /**
     * @return int
     */
    public function getPhone(): int
    {
        return $this->phone;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @throws ParseException
     */
    public static function frommArray(array $data): static
    {
        return new static(
            self::parseInt($data['phone']),
            self::parseNullableString($data['email']),
            self::parseString($data['name']),
            self::parseString($data['surname']),
            self::parseString($data['password']),
        );
    }

    public function jsonSerialize(): array
    {
        return [];
    }
}
