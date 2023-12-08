<?php

namespace App\Models\RBAC;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AbilityOfUser
 *
 * @property int $id
 * @property int $merchant_of_user_id
 * @property int $ability_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|AbilityOfUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AbilityOfUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AbilityOfUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|AbilityOfUser whereAbilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AbilityOfUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AbilityOfUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AbilityOfUser whereMerchantOfUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AbilityOfUser whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class AbilityOfUser extends Model {
    use HasFactory;
}
