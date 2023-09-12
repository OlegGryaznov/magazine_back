<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ModelActiveScope implements Scope
{
    protected string $column;
    protected $value;

    public function __construct(string $column = 'is_active', $value = 1)
    {
        $this->column = $column;
        $this->value = $value;
    }

    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder->where($this->column, $this->value);
    }
}
