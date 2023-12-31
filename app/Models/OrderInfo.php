<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_name',
        'email',
        'phone',
        'ttn',
        'comment',
        'city',
        'delivery',
        'delivery_address',
        'provider',
        'department'
    ];
}
