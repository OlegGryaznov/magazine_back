<?php

namespace App\Models;

use App\Models\Scopes\ModelActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class DeliveryProvider extends Model
{
    use HasFactory;

    const IS_ACTIVE = 1;

    protected $fillable = [
        'name',
        'is_active'
    ];

    public static function booted()
    {
        static::addGlobalScope(new ModelActiveScope());
    }

    public function orders() : BelongsToMany
    {
        return $this->belongsToMany(Order::class,'order_delivery', 'delivery_provider_id');
    }
}
