<?php

namespace App\Models\Media;

use App\Models\Merchant\Room;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * App\Models\Image
 *
 * @property string $image_path
 * @property bool $parent_image
 * @property int $id
 * @property string $parentable_type
 * @property int $parentable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $parentable
 * @property-read Room|null $room
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image query()
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereParentImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereParentableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereParentableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Image extends Model {
    protected $table = 'images_morph';

    public function parentable(): MorphTo {
        return $this->morphTo();
    }

    protected function imagePath(): Attribute {
        $url = config('app.url');

        return Attribute::make(
            get: fn (string $value) => $url.'storage/'.$value,
        );
    }

    public function room(): BelongsTo {
        return $this->belongsTo(Room::class);
    }
}
