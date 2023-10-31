<?php

namespace App\Models\Merchant;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property int $id
 *@property string $title_uz
 *@property string $title_ru
 *@property string $title_en
 *@property array|null $title
 *@property int $price
 *@property int $merchant_id
 *@property Image $images
 */
class Room extends Model {

    use HasFactory;

    protected $table = 'rooms';

    public function images(): MorphMany {
        return $this->morphMany(Image::class, 'parentable');
    }

    public function merchant(): BelongsTo {
        return $this->belongsTo(Merchant::class, 'merchant_id', 'id');
    }

    public function roomFeatures(): BelongsToMany {
        return $this->belongsToMany(
            RoomFeature::class,
            'room_features_pivot',
            'room_id',
            'room_feature_id'
        );
    }

    public function getTitleAttribute() {
        return $this->title = [
            'en' => $this->title_en,
            'ru' => $this->title_ru,
            'uz' => $this->title_uz,
        ];
    }
}
