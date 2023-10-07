<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property int|null $village_id
 * @property int|null $district_id
 *@property string $title_uz
 *@property string $title_ru
 *@property string $title_en
 *@property string $description_uz
 *@property string $description_ru
 *@property string $description_en
 *@property float $latitude
 *@property float $longitude
 *@property int $book_commisison
 */
class Merchant extends Model
{
    protected $table = 'merchants';

    public function merchantsUser(): BelongsToMany
    {
        return $this->belongsToMany(
            MerchantUser::class,
            'merchant_user_merchants_pivot',
            'merchant_id',
            'merchant_user_id'
        );
    }

    public function merchantsCategories(): BelongsToMany
    {
        return $this->belongsToMany(
            Category::class,
            'merchat_categories_pivot',
            'merchant_id',
            'category_id'
        );
    }

    public function merchantsFeatures(): BelongsToMany
    {
        return $this->belongsToMany(
            MerchantFeature::class,
            'merchant_features_pivot',
            'merchant_id',
            'merchant_feature_id'
        );
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'parentable');
    }
}
