<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Common\District
 *
 * @property int $id
 * @property int $region_id
 * @property string $name_uz
 * @property string $name_oz
 * @property string $name_ru
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|District newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|District newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|District query()
 * @method static \Illuminate\Database\Eloquent\Builder|District whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereNameOz($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereNameUz($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class District extends Model {
    use HasFactory;
}
