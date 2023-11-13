<?php

namespace App\Models\Tenant;

use App\Models\Tenant\RestaurantUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    protected $table = 'sales';

    protected $fillable = [
        'product_id',
        'order_id',
        'user_id',
        'quantity',
        'price',
        'discount',
        'total',
        'sale_date'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(RestaurantUser::class);
    }
}
