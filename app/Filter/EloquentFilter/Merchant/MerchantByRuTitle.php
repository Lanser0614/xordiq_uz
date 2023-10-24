<?php

declare(strict_types=1);

namespace App\Filter\EloquentFilter\Merchant;

use App\Filter\Interface\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

class MerchantByRuTitle implements FilterInterface {
    public function filter(Builder $builder, mixed $value): Builder {
        return $builder->where('title_ru', 'like', "%{$value}%");
    }

    public function getBindingName(): string {
        return 'ru';
    }
}
