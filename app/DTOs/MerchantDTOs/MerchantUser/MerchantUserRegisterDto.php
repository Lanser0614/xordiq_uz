<?php

namespace App\DTOs\MerchantDTOs\MerchantUser;

use App\DTOs\BaseDTO\BaseDTO;
use App\Exceptions\DtoException\ParseException;

final class MerchantUserRegisterDto extends BaseDTO {
    public function __construct(
        private readonly int $phone,
        private readonly ?string $email,
        private readonly string $name,
        private readonly string $surname,
        private readonly string $password,
    ) {
    }

    public function getPhone(): int {
        return $this->phone;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getSurname(): string {
        return $this->surname;
    }

    public function getPassword(): string {
        return $this->password;
    }

    /**
     * @throws ParseException
     */
    public static function frommArray(array $data): static {
        return new self(
            self::parseInt($data['phone']),
            self::parseNullableString($data['email']),
            self::parseString($data['name']),
            self::parseString($data['surname']),
            self::parseString($data['password']),
        );
    }

    public function jsonSerialize(): array {
        return [];
    }
}
