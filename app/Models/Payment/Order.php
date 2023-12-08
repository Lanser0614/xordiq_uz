<?php

namespace App\Models\Payment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Payment\Order
 *
 * @property int $id
 * @property int $user_id
 * @property int $merchant_user_id
 * @property int $room_id
 * @property int $human_count
 * @property int $is_cooperative
 * @property int|null $amount_with_discount bu columnga yoziladi qachonki odam soni ko'p bo'p berilgan narxdan skidka berishmoqchi bo'sa
 * @property string $status
 * @property int $processed_by_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAmountWithDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereHumanCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereIsCooperative($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereMerchantUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereProcessedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 *
 * @mixin \Eloquent
 */
class Order extends Model {
    use HasFactory;

    protected $table = 'orders';
}
