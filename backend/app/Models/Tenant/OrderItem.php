<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{

    protected $table = 'order_items';

    protected $fillable = [
        'order_id',
        'item_id',
        'quantity',
        'price',
        'options_price',
        'total',
        'notes',
        'checkbox_options',
        'selection_options',
        'dropdown_options'
    ];
    protected $casts = [
        'checkbox_options' => 'array',
        'selection_options' => 'array',
        'dropdown_options' => 'array',
    ];
    // protected $casts = [
    //     'extras' => 'array', // Cast the JSON extras column to an array
    // ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
