<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;

class DeliveryType extends Model
{
    protected $table = 'delivery_types';
    public const CHANGEABLE_COST = -1;

    protected $fillable = [
        'id',
        'name',
        'description',
        'icon',
        'cost'
    ];

    public $translatable = ['description'];

    const DELIVERY = 'Delivery';
    const PICKUP = 'PICKUP';
    const PICKUP_BY_CAR = 'PICKUP By Car';

    public function orders()
    {
        return $this->hasMany(Order::class);
    }


}
