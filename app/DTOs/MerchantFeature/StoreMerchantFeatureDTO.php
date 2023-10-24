<?php

namespace App\DTOs\MerchantFeature;

use App\DTOs\BaseDTO\BaseDTO;
use App\Exceptions\DtoException\ParseException;
use Illuminate\Http\UploadedFile;

final class StoreMerchantFeatureDTO extends BaseDTO {
    public function __construct(
        private readonly string $title_uz,
        private readonly string $title_ru,
        private readonly string $title_en,
        private readonly UploadedFile $icon,
    ) {
    }

    public function getTitleUz(): string {
        return $this->title_uz;
    }

    public function getTitleRu(): string {
        return $this->title_ru;
    }

    public function getTitleEn(): string {
        return $this->title_en;
    }

    public function getIcon(): UploadedFile {
        return $this->icon;
    }

    /**
     * @throws ParseException
     */
    public static function frommArray(array $data) {
        return new self(
            self::parseString($data['title_uz']),
            self::parseString($data['title_ru']),
            self::parseString($data['title_en']),
            $data['icon'],
        );
    }

    public function jsonSerialize(): mixed {
        // TODO: Implement jsonSerialize() method.
    }
}
