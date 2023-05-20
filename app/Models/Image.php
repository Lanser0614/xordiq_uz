<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\App;

/**
 * @property string $image_path
 * @property int $parent_image
 */
class Image extends Model
{
    private string $appUrl = 'http://localhost:8000/';

    private string $appProdUrl = 'http://159.65.149.53/';

    protected $table = 'images_morph';

    public function parentable(): MorphTo
    {
        return $this->morphTo();
    }

    protected function imagePath(): Attribute
    {
        if (App::isLocal()) {
            $url = $this->appProdUrl;
        } else {
            $url = $this->appUrl;
        }

        return Attribute::make(
            get: fn (string $value) => $url.$value,
        );
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}
