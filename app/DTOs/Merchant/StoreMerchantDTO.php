<?php

namespace App\DTOs\Merchant;

use App\DTOs\BaseDTO\BaseDTO;
use App\Exceptions\DtoException\ParseException;
use Illuminate\Http\UploadedFile;

final class StoreMerchantDTO extends BaseDTO
{
    public function __construct(
        private readonly string $title_uz,
        private readonly string $title_ru,
        private readonly string $title_en,
        private readonly string $description_uz,
        private readonly string $description_ru,
        private readonly string $description_en,
        private readonly ?int $village_id,
        private readonly ?int $district_id,
        private readonly float $latitude,
        private readonly float $longitude,
        private readonly int $book_commisison,
        private readonly UploadedFile $home_photo,
        private readonly array $photos,
        private readonly array $categoryIds,
        private readonly ?array $merchantFeaturesIds
    ) {
    }

    public function getMerchantFeaturesIds(): ?array
    {
        return $this->merchantFeaturesIds;
    }

    public function getCategoryIds(): array
    {
        return $this->categoryIds;
    }

    public function getVillageId(): ?int
    {
        return $this->village_id;
    }

    public function getDistrictId(): ?int
    {
        return $this->district_id;
    }

    public function getHomePhoto(): UploadedFile
    {
        return $this->home_photo;
    }

    public function getPhotos(): array
    {
        return $this->photos;
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
        return new self(
            title_uz: self::parseString($data['title_uz']),
            title_ru: self::parseString($data['title_ru']),
            title_en: self::parseString($data['title_en']),
            description_uz: self::parseString($data['description_uz']),
            description_ru: self::parseString($data['description_ru']),
            description_en: self::parseString($data['description_en']),
            village_id: self::parseNullableInt($data['village_id']),
            district_id: self::parseNullableInt($data['district_id']),
            latitude: self::parseFloat($data['latitude']),
            longitude: self::parseFloat($data['longitude']),
            book_commisison: self::parseInt($data['book_commisison']),
            home_photo: $data['home_photo'],
            photos: self::parseArray($data['photos']),
            categoryIds: self::parseArray($data['category_ids']),
            merchantFeaturesIds: self::parseNullableArray($data['merchant_features_ids']),
        );
    }

    public function jsonSerialize(): array
    {
        return [];
    }
}
