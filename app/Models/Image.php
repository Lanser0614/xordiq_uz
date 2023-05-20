<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 *@property string $image_path
 *@property int $parent_image
 */
class Image extends Model
{
    protected $table = 'images_morph';
    public function parentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}
