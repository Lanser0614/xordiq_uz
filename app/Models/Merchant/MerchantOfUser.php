<?php

declare(strict_types=1);

namespace App\Models\Merchant;

use App\Models\RBAC\Ability;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Merchant\MerchantOfUser
 *
 * @property Collection|null $merchantOfUserAbilities
 * @property int $id
 * @property int $merchant_user_id
 * @property int $merchant_id
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read int|null $merchant_of_user_abilities_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|MerchantOfUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MerchantOfUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MerchantOfUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|MerchantOfUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MerchantOfUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MerchantOfUser whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MerchantOfUser whereMerchantUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MerchantOfUser whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MerchantOfUser whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class MerchantOfUser extends Model {
    protected $table = 'merchants_of_user';

    public function merchantOfUserAbilities(): BelongsToMany {
        return $this->belongsToMany(
            Ability::class,
            'ability_of_users',
            'merchant_of_user_id',
            'ability_id'
        );
    }
}
