<?php

namespace App\Models\Merchant;

use App\Filter\BaseFilter\BaseFilter;
use App\Models\Common\Category;
use App\Models\Common\District;
use App\Models\Common\Region;
use App\Models\Common\Village;
use App\Models\Media\Image;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Ramsey\Collection\Collection;

/**
 * App\Models\Merchant\Merchant
 *
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
 * @property int $book_commission
 * @property Collection|Room[] $rooms
 *
 * @property Village $village
 * @property District $district
 *
 * @method static Builder|self filter($request, $filters)
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Image> $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Category> $merchantsCategories
 * @property-read int|null $merchants_categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, MerchantFeature> $merchantsFeatures
 * @property-read int|null $merchants_features_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, MerchantUser> $merchantsUser
 * @property-read int|null $merchants_user_count
 * @property-read int|null $rooms_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Room> $roomsLimit
 * @property-read int|null $rooms_limit_count
 *
 * @method static Builder|Merchant newModelQuery()
 * @method static Builder|Merchant newQuery()
 * @method static Builder|Merchant query()
 * @method static Builder|Merchant whereBookCommission($value)
 * @method static Builder|Merchant whereCreatedAt($value)
 * @method static Builder|Merchant whereDescriptionEn($value)
 * @method static Builder|Merchant whereDescriptionRu($value)
 * @method static Builder|Merchant whereDescriptionUz($value)
 * @method static Builder|Merchant whereDistrictId($value)
 * @method static Builder|Merchant whereId($value)
 * @method static Builder|Merchant whereLatitude($value)
 * @method static Builder|Merchant whereLongitude($value)
 * @method static Builder|Merchant whereTitleEn($value)
 * @method static Builder|Merchant whereTitleRu($value)
 * @method static Builder|Merchant whereTitleUz($value)
 * @method static Builder|Merchant whereUpdatedAt($value)
 * @method static Builder|Merchant whereVillageId($value)
 *
 * @mixin Eloquent
 */
class Merchant extends Model {
    protected $table = 'merchants';

    public function merchantsUser(): BelongsToMany {
        return $this->belongsToMany(
            MerchantUser::class,
            'merchants_of_user',
            'merchant_id',
            'merchant_user_id'
        )->withPivot(['role']);
    }

    public function village(): HasOne
    {
        return $this->hasOne(Region::class, 'id', 'village_id');
    }

    public function district(): HasOne
    {
        return $this->hasOne(District::class, 'id', 'district_id');
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
