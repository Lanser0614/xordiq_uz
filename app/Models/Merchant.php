<?php

namespace App\Models;

use App\Filter\BaseFilter\BaseFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Http\Request;

/**
 * @property int $id
 * @property int|null $village_id
 * @property int|null $district_id
 * @property string $title_uz
 * @property string $title_ru
 * @property string $title_en
 * @property array|null $title
 * @property string $description_uz
 * @property string $description_ru
 * @property string $description_en
 * @property array|null $description
 * @property float $latitude
 * @property float $longitude
 * @property int $book_commisison
 *
 * @method static Builder|self filter($request, $filters)
 */
class Merchant extends Model {
    protected $table = 'merchants';

    public function merchantsUser(): BelongsToMany {
        return $this->belongsToMany(
            MerchantUser::class,
            'merchant_user_merchants_pivot',
            'merchant_id',
            'merchant_user_id'
        );
    }

    public function merchantsCategories(): BelongsToMany {
        return $this->belongsToMany(
            Category::class,
            'merchat_categories_pivot',
            'merchant_id',
            'category_id'
        );
    }

    public function merchantsFeatures(): BelongsToMany {
        return $this->belongsToMany(
            MerchantFeature::class,
            'merchant_features_pivot',
            'merchant_id',
            'merchant_feature_id'
        );
    }

    public function rooms(): HasMany {
        return $this->hasMany(Room::class);
    }

    public function roomsLimit(): HasMany {
        return $this->hasMany(Room::class)->take(1);
    }

    public function images(): MorphMany {
        return $this->morphMany(Image::class, 'parentable');
    }

    public function scopeFilter($builder, Request $request, array $filters): Builder {
        return (new BaseFilter($builder, $request, $filters))->apply();
    }

    public function getTitleAttribute() {
        return $this->title = [
            'en' => $this->title_en,
            'ru' => $this->title_ru,
            'uz' => $this->title_uz,
        ];
    }

    public function getDescriptionAttribute(): array {
        return $this->description = [
            'en' => $this->description_en,
            'ru' => $this->description_ru,
            'uz' => $this->description_uz,
        ];
    }
}
