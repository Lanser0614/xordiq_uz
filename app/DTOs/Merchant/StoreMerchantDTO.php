<?php

namespace App\DTOs\Merchant;

use App\DTOs\BaseDTO\BaseDTO;
use App\Exceptions\DtoException\ParseException;
use Illuminate\Http\UploadedFile;

class StoreMerchantDTO extends BaseDTO
{
    public function __construct(
        private readonly string       $title_uz,
        private readonly string       $title_ru,
        private readonly string       $title_en,
        private readonly string       $description_uz,
        private readonly string       $description_ru,
        private readonly string       $description_en,
        private readonly float        $latitude,
        private readonly float        $longitude,
        private readonly int          $book_commisison,
        private readonly UploadedFile $home_photo,
        private readonly array        $photos,
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
     * @return string
     */
    public function getTitleEn(): string
    {
        return $this->title_en;
    }

    /**
     * @return string
     */
    public function getDescriptionUz(): string
    {
        return $this->description_uz;
    }

    /**
     * @return string
     */
    public function getDescriptionRu(): string
    {
        return $this->description_ru;
    }

    /**
     * @return string
     */
    public function getDescriptionEn(): string
    {
        return $this->description_en;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @return int
     */
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
            title_uz: self::parseString($data['title_uz']),
            title_ru: self::parseString($data['title_ru']),
            title_en: self::parseString($data['title_en']),
            description_uz: self::parseString($data['description_uz']),
            description_ru: self::parseString($data['description_ru']),
            description_en: self::parseString($data['description_en']),
            latitude: self::parseFloat($data['latitude']),
            longitude: self::parseFloat($data['longitude']),
            book_commisison: self::parseInt($data['book_commisison']),
            home_photo: $data['home_photo'],
            photos: self::parseArray($data['photos'])
        );
    }

    public function jsonSerialize(): array
    {
        return [];
    }
}
