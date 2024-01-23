<?php

namespace App\DTOs\MobileDTOs\User;

use App\DTOs\BaseDTO\BaseDTO;
use App\Exceptions\DtoException\ParseException;

final class UserRegisterDto extends BaseDTO {
    public function __construct(
        private readonly int $phone,
        private readonly ?string $email,
        private readonly string $name,
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
            self::parseString($data['password']),
        );
    }

    public function jsonSerialize(): array {
        return [];
    }
}
