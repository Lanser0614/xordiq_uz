<?php

namespace App\Models\Merchant;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticate;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * App\Models\Merchant\MerchantUser
 *
 * @property int $id
 * @property int $otp
 * @property int $phone
 * @property string $email
 * @property string $name
 * @property string $surname
 * @property string $role
 * @property string $remember_token
 * @property string $password
 * @property Carbon|null $email_verified_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $parent_user_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Merchant\Merchant> $merchants
 * @property-read int|null $merchants_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|MerchantUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MerchantUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MerchantUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|MerchantUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MerchantUser whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MerchantUser whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MerchantUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MerchantUser whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MerchantUser whereOtp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MerchantUser whereParentUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MerchantUser wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MerchantUser wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MerchantUser whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MerchantUser whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MerchantUser whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MerchantUser whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class MerchantUser extends Authenticate {
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $table = 'merchant_users';

    public function merchants(): BelongsToMany {
        return $this->belongsToMany(
            Merchant::class,
            'merchants_of_user',
            'merchant_user_id',
            'merchant_id',
        );
    }
}
