<?php

namespace App\Models\Tenant;

use Database\Factories\tenant\DeliveryTypeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryType extends Model
{
    use HasFactory;
    protected $table = 'delivery_types';
    public const CHANGEABLE_COST = -1;

    protected $fillable = [
        'id',
        'name',
        'description',
        'icon',
        'cost',
        'is_active',
        'helper_message'
    ];

    public $translatable = ['description'];

    const DELIVERY = 'Delivery';
    const PICKUP = 'PICKUP';
//    const PICKUP_BY_CAR = 'PICKUP By Car';

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    protected static function newFactory()
    {
      return DeliveryTypeFactory::new();
    }


}
