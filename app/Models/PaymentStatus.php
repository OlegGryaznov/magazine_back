<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    use HasFactory;

    const STATUS_PAID = 1;
    const STATUS_AWAITING = 2;

    protected $fillable = ['name'];
}
