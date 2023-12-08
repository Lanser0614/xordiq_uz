<?php

namespace App\Models\Merchant;

use App\Models\Media\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * App\Models\Merchant\MerchantFeature
 *
 * @property string $title_uz
 * @property string $title_ru
 * @property string $title_en
 * @property array|null $title
 * @property Image $image
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|MerchantFeature newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MerchantFeature newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MerchantFeature query()
 * @method static \Illuminate\Database\Eloquent\Builder|MerchantFeature whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MerchantFeature whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MerchantFeature whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MerchantFeature whereTitleRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MerchantFeature whereTitleUz($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MerchantFeature whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class MerchantFeature extends Model {
    protected $table = 'merchant_features';

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
