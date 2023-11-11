<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $table = 'shipments';

    protected $fillable = [
        'order_id',
        'address_id',
        'shipment_status',
        'tracking_number',
        'shipping_date',
        'estimated_arrival_date',
        'actual_arrival_date',
        'carrier',
        'shipping_fee',
        'notes'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function items()
    {
        return $this->belongsToMany(Product::class, 'shipment_items')
            ->withPivot('quantity');
    }
}
