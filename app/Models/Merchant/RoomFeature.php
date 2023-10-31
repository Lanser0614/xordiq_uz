<?php

namespace App\Models\Merchant;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @property string $title_uz
 * @property string $title_ru
 * @property string $title_en
 * @property array|null $title
 */
class RoomFeature extends Model {
    use HasFactory;

    protected $table = 'room_features';

    public function image(): MorphOne {
        return $this->morphOne(Image::class, 'parentable');
    }

    public function getTitleAttribute() {
        return $this->title = [
            'en' => $this->title_en,
            'ru' => $this->title_ru,
            'uz' => $this->title_uz,
        ];
    }
}
