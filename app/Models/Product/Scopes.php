<?php

namespace App\Models\Product;

trait Scopes
{
    public function scopeActive($query)
    {
        return $query->where('is_active', self::IS_ACTIVE);
    }
}
