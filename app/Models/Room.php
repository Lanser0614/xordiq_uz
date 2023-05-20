<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property int $id
 *@property string $title_uz
 *@property string $title_ru
 *@property string $title_en
 *@property int $price
 *@property int $merchant_id
 *@property Image $images
 */
class Room extends Model
{
    protected $table = 'rooms';

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'parentable');
    }

    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class, 'merchant_id', 'id');
    }
}
