<?php

declare(strict_types=1);

namespace App\Models\Merchant;

use App\Models\Ability;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property Collection|null $merchantOfUserAbilities
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
