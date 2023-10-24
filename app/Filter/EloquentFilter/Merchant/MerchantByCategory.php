<?php

declare(strict_types=1);

namespace App\Filter\EloquentFilter\Merchant;

use App\Filter\Interface\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

class MerchantByCategory implements FilterInterface {
    public function filter(Builder $builder, mixed $value): Builder {
        return $builder->whereHas('merchantsCategories', function (Builder $query) use ($value) {
            $query->where('category_id', $value);
        });
    }

    public function getBindingName(): string {
        return 'category_id';
    }
}
