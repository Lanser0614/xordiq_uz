<?php

namespace App\DTOs\Merchant;

use App\DTOs\BaseDTO\BaseDTO;
use App\Exceptions\DtoException\ParseException;

class UpdateMerchantDTO extends BaseDTO
{
    public function __construct(
        private readonly string $title_uz,
        private readonly string $title_ru,
        private readonly string $title_en,
        private readonly string $description_uz,
        private readonly string $description_ru,
        private readonly string $description_en,
        private readonly float $latitude,
        private readonly float $longitude,
        private readonly int $book_commisison
    ) {
    }

    public function getTitleUz(): string
    {
        return $this->title_uz;
    }

    public function getTitleRu(): string
    {
        return $this->title_ru;
    }

    public function getTitleEn(): string
    {
        return $this->title_en;
    }

    public function getDescriptionUz(): string
    {
        return $this->description_uz;
    }

    public function getDescriptionRu(): string
    {
        return $this->description_ru;
    }

    public function getDescriptionEn(): string
    {
        return $this->description_en;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function getBookCommisison(): int
    {
        return $this->book_commisison;
    }

    /**
     * @throws ParseException
     */
    public static function frommArray(array $data)
    {
        return new static(
            self::parseString($data['title_uz']),
            self::parseString($data['title_ru']),
            self::parseString($data['title_en']),
            self::parseString($data['description_uz']),
            self::parseString($data['description_ru']),
            self::parseString($data['description_en']),
            self::parseFloat($data['latitude']),
            self::parseFloat($data['longitude']),
            self::parseInt($data['book_commisison'])
        );
    }

    public function jsonSerialize(): array
    {
        return [];
    }
}
