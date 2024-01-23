<?php

namespace App\Models\Merchant;

use App\Models\Media\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * App\Models\Merchant\RoomFeature
 *
 * @property string $title_uz
 * @property string $title_ru
 * @property string $title_en
 * @property array|null $title
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Image|null $image
 *
 * @method static \Illuminate\Database\Eloquent\Builder|RoomFeature newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoomFeature newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoomFeature query()
 * @method static \Illuminate\Database\Eloquent\Builder|RoomFeature whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomFeature whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomFeature whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomFeature whereTitleRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomFeature whereTitleUz($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomFeature whereUpdatedAt($value)
 *
 * @mixin \Eloquent
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
