<?php

declare(strict_types=1);

namespace App\Filter\EloquentFilter\Merchant;

use App\Filter\Interface\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

class MerchantByIds implements FilterInterface {
    public function filter(Builder $builder, mixed $value): Builder {
        $ids = explode(',', $value);

        return $builder->whereIn('id', $ids);
    }

    public function getBindingName(): string {
        return 'merchant_ids';
    }
}
