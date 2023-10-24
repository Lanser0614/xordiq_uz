<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticate;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 *@property int $otp
 *@property int $phone
 *@property string $email
 *@property string $name
 *@property string $surname
 *@property string $role
 *@property string $remember_token
 *@property string $password
 *@property Carbon|null $email_verified_at
 */
class MerchantUser extends Authenticate {
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $table = 'merchant_users';

    public function merchants(): BelongsToMany {
        return $this->belongsToMany(
            Merchant::class,
            'merchant_user_merchants_pivot',
            'merchant_user_id',
            'merchant_id',
        );
    }
}
