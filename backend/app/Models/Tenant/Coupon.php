<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupons';

    protected $fillable = [
        'code',
        'description',
        'type',
        'value',
        'minimum_order_amount',
        'maximum_discount_amount',
        'usage_limit',
        'usage_count',
        'start_date',
        'end_date',
        'is_active'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
