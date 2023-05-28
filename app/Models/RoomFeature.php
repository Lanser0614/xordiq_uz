<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @property string $title_uz
 * @property string $title_ru
 * @property string $title_en
 */
class RoomFeature extends Model
{
    use HasFactory;

    protected $table = 'room_features';

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'parentable');
    }
}
