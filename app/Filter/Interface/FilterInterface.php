<?php

namespace App\Filter\Interface;

use Illuminate\Database\Eloquent\Builder;

interface FilterInterface
{
    /**
     * @param Builder $builder
     * @param mixed $value
     * @return Builder
     */
    public function filter(Builder $builder, mixed $value): Builder;

    /**
     * @return string
     */
    public function getBindingName(): string;
}
