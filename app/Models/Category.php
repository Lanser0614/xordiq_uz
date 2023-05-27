<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $title_uz
 * @property string $title_ru
 * @property string $title_en
 * @property int|null $parent_id
 */
class Category extends Model
{
    use HasFactory;
}
