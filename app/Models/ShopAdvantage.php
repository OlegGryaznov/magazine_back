<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopAdvantage extends Model
{
    use HasFactory;

    const IS_ACTIVE = 1;

    protected $fillable = [
        'text',
        'is_active'
    ];

    public function scopeActive($query)
    {
        $query->where('is_active', self::IS_ACTIVE);
    }
}
