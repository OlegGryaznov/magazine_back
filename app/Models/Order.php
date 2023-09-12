<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'order_status_id',
        'payment_status_id',
        'payment_id',
        'total_price',
        'delivery_status_id',
    ];

    /**
     * @return BelongsToMany
     */
    public function products() : BelongsToMany
    {
        return $this->belongsToMany(Product::class,'order_product','order_id');
    }

    /**
     * @return HasOne
     */
    public function info() : HasOne
    {
        return $this->hasOne(OrderInfo::class);
    }

    /**
     * @return BelongsToMany
     */
    public function providers() : BelongsToMany
    {
        return $this->belongsToMany(DeliveryProvider::class,'order_delivery');
    }

    /**
     * @return BelongsTo
     */
    public function deliveryStatus(): BelongsTo
    {
        return $this->belongsTo(DeliveryStatus::class);
    }

    /**
     * @return BelongsTo
     */
    public function orderStatus(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class);
    }

    /**
     * @return BelongsTo
     */
    public function paymentStatus(): BelongsTo
    {
        return $this->belongsTo(PaymentStatus::class);
    }
}
