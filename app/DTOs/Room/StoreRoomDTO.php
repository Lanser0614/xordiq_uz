<?php

namespace App\DTOs\Room;

use App\DTOs\BaseDTO\BaseDTO;
use Illuminate\Http\UploadedFile;
use App\Exceptions\DtoException\ParseException;

final class StoreRoomDTO extends BaseDTO
{
    public function __construct(
        private readonly string $title_en,
        private readonly string $title_uz,
        private readonly string $title_ru,
        private readonly float $price,
        private readonly UploadedFile $home_photo,
        private readonly array $photos,
        private readonly array $roomFeatureIds
    ) {
    }

    public function getRoomFeatureIds(): array
    {
        return $this->roomFeatureIds;
    }

    public function getHomePhoto(): UploadedFile
    {
        return $this->home_photo;
    }

    public function getPhotos(): array
    {
        return $this->photos;
    }

    public function getTitleEn(): string
    {
        return $this->title_en;
    }

    public function getTitleUz(): string
    {
        return $this->title_uz;
    }

    public function getTitleRu(): string
    {
        return $this->title_ru;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getPriceOnTinn(): int
    {
        return $this->toTinn(round($this->price, 2));
    }

    /**
     * @throws ParseException
     */
    public static function frommArray(array $data): StoreRoomDTO
    {
        return new self(
            title_en: self::parseString($data['title_en']),
            title_uz: self::parseString($data['title_uz']),
            title_ru: self::parseString($data['title_ru']),
            price: self::parseFloat($data['price']),
            home_photo: $data['home_photo'],
            photos: $data['photos'],
            roomFeatureIds: self::parseArray($data['room_feature_ids'])
        );
    }

    public function jsonSerialize(): array
    {
        return [];
    }
}
