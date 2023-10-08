<?php

declare(strict_types=1);

namespace App\Filter\BaseFilter;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\Interface\FilterInterface;

class BaseFilter
{
    protected Builder $builder;
    protected Request $request;
    protected array $filters = [];

    public function __construct(Builder $builder, Request $request, array $filters)
    {
        $this->builder = $builder;
        $this->request = $request;
        $this->filters = $filters;
    }

    public function query(): array
    {
        return $this->request->all();
    }

    public function apply(): Builder
    {
        foreach ($this->filters as $filter) {
            /** @var FilterInterface $value */
            if (array_key_exists((new $filter)->getBindingName(), $this->query())) {
                (new $filter)->filter($this->builder, $this->query()[(new $filter)->getBindingName()]);
            }
        }

        return $this->builder;
    }
}
