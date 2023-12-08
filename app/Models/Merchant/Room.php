<?php

namespace App\Models\Merchant;

use App\Models\Media\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * App\Models\Merchant\Room
 *
 * @property int $id
 * @property string $title_uz
 * @property string $title_ru
 * @property string $title_en
 * @property array|null $title
 * @property int $price
 * @property int $merchant_id
 * @property Image $images
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read int|null $images_count
 * @property-read \App\Models\Merchant\Merchant $merchant
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Merchant\RoomFeature> $roomFeatures
 * @property-read int|null $room_features_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Room newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Room newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Room query()
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereTitleRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereTitleUz($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereUpdatedAt($value)
 *
 * @mixin \Eloquent
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
