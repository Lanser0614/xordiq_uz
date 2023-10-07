<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $image_path
 * @property bool $parent_image
 */
class Image extends Model
{
    protected $table = 'images_morph';

    public function parentable(): MorphTo
    {
        return $this->morphTo();
    }

    protected function imagePath(): Attribute
    {
        $url = config('app.url');

        return Attribute::make(
            get: fn (string $value) => $url . $value,
        );
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}
