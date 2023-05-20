<?php

namespace App\DTOs\Room;

use App\DTOs\BaseDTO\BaseDTO;
use App\Exceptions\DtoException\ParseException;
use Illuminate\Http\UploadedFile;

class StoreRoomDTO extends BaseDTO
{
    public function __construct(
        private readonly string $title_en,
        private readonly string $title_uz,
        private readonly string $title_ru,
        private readonly int    $price,
        private readonly UploadedFile    $home_photo,
        private readonly array    $photos,
    )
    {
    }

    /**
     * @return UploadedFile
     */
    public function getHomePhoto(): UploadedFile
    {
        return $this->home_photo;
    }

    /**
     * @return array
     */
    public function getPhotos(): array
    {
        return $this->photos;
    }

    /**
     * @return string
     */
    public function getTitleEn(): string
    {
        return $this->title_en;
    }

    /**
     * @return string
     */
    public function getTitleUz(): string
    {
        return $this->title_uz;
    }

    /**
     * @return string
     */
    public function getTitleRu(): string
    {
        return $this->title_ru;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @throws ParseException
     */
    public static function frommArray(array $data)
    {
        return new static(
            title_en: self::parseString($data['title_en']),
            title_uz: self::parseString($data['title_uz']),
            title_ru: self::parseString($data['title_ru']),
            price: self::parseInt($data['price']),
            home_photo: $data['home_photo'],
            photos: $data['photos']
        );
    }

    public function jsonSerialize(): mixed
    {
        // TODO: Implement jsonSerialize() method.
    }
}
