<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryStatus extends Model
{
    use HasFactory;

    const STATUS_NOT_SHIPPED = 1;
    const STATUS_SHIPPED = 2;

    protected $fillable = ['name'];
}
