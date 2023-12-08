<?php

namespace App\Models\User;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\User\Favorite
 *
 * @property int $id
 * @property int $user_id
 * @property int $merchant_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|Favorite newModelQuery()
 * @method static Builder|Favorite newQuery()
 * @method static Builder|Favorite query()
 * @method static Builder|Favorite whereCreatedAt($value)
 * @method static Builder|Favorite whereId($value)
 * @method static Builder|Favorite whereMerchantId($value)
 * @method static Builder|Favorite whereUpdatedAt($value)
 * @method static Builder|Favorite whereUserId($value)
 *
 * @mixin Eloquent
 */
class Favorite extends Model {
    use HasFactory;
}
