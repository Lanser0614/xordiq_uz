<?php

declare(strict_types=1);

namespace App\DTOs\MerchantDTOs\Transalation;

class TranslationDTO {
    public function __construct(
        protected readonly array $title,
        protected readonly array $description,
    ) {
    }

    public static function fromArray(array $data): static {
        return new static(
            title: $data['title'],
            description: $data['description']
        );
    }

    public function getTitle(): array {
        return $this->title;
    }

    public function getDescription(): array {
        return $this->description;
    }
}
