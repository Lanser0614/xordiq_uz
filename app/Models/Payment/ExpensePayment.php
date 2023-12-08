<?php

namespace App\Models\Payment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Payment\ExpensePayment
 *
 * @property int $id
 * @property int $amount
 * @property string $date
 * @property string $comment
 * @property string $expense_payment_type
 * @property string $expense_payment_method_key
 * @property int $is_canceled
 * @property string $canceled_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ExpensePayment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpensePayment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpensePayment query()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpensePayment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpensePayment whereCanceledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpensePayment whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpensePayment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpensePayment whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpensePayment whereExpensePaymentMethodKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpensePayment whereExpensePaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpensePayment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpensePayment whereIsCanceled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpensePayment whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class ExpensePayment extends Model {
    use HasFactory;
}
