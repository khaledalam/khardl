<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{

    protected $table = 'order_items';

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'extras',
        'size',
        'preparation_time'
    ];

    protected $casts = [
        'extras' => 'array', // Cast the JSON extras column to an array
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function extras()
    {
        return $this->belongsToMany(ProductExtra::class, 'order_item_extras');
    }

    public function size()
    {
        return $this->belongsTo(ProductSize::class);
    }
}
