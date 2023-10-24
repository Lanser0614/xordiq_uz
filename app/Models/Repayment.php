<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $transaction_id
 * @property int $amount
 * @property Carbon $date
 * @property string $comment
 * @property int $order_id
 * @property bool $is_canceled
 * @property bool $is_commission_taken
 * @property Carbon $canceled_at
 */
class Repayment extends Model {
    use HasFactory;
}
