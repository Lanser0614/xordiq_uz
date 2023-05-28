<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 *@property string $title_uz
 *@property string $title_ru
 *@property string $title_en
 */
class MerchantFeature extends Model
{
    protected $table = 'merchant_features';

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'parentable');
    }
}
