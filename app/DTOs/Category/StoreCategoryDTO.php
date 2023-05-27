<?php

namespace App\DTOs\Category;

use App\DTOs\BaseDTO\BaseDTO;
use App\Exceptions\DtoException\ParseException;

class StoreCategoryDTO extends BaseDTO
{
    public function __construct(
        private readonly string $title_uz,
        private readonly string $title_ru,
        private readonly string $title_en,
        private readonly ?int $parent_id,
    ) {
    }

    public function getParentId(): ?int
    {
        return $this->parent_id;
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

    /**
     * @throws ParseException
     */
    public static function frommArray(array $data)
    {
        return new static(
            self::parseString($data['title_uz']),
            self::parseString($data['title_ru']),
            self::parseString($data['title_en']),
            self::parseNullableInt($data['parent_id']),
        );
    }

    public function jsonSerialize(): array
    {
        return [];
    }
}
