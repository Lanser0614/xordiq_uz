<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property int $id
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

    /**
     * @return BelongsToMany
     */
    public function merchantsUser(): BelongsToMany
    {
        return $this->belongsToMany(
            MerchantUser::class,
            "merchantUser_merchants_pivot",
            "merchant_id",
            "merchantUser_id"
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
