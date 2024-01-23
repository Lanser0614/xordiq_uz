<?php

namespace App\Models\Payment;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Payment\Repayment
 *
 * @property int $id
 * @property int $transaction_id
 * @property int $amount
 * @property Carbon $date
 * @property string $comment
 * @property int $order_id
 * @property bool $is_canceled
 * @property bool $is_commission_taken
 * @property Carbon $canceled_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Repayment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Repayment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Repayment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Repayment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repayment whereCanceledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repayment whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repayment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repayment whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repayment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repayment whereIsCanceled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repayment whereIsCommissionTaken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repayment whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repayment whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Repayment extends Model {
    use HasFactory;
}
