<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table = 'cart_items';

    protected $fillable = [
        'cart_id',
        'item_id',
        'quantity',
        'options_price',
        'total',
        'price',
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

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
