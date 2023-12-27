<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;

class DeliveryCompany extends Model
{
    protected $table = 'delivery_company';

    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
        'extra_price',
        'coverage_km',
        'contract',
        'profile',
        'payments',
        'api_key',
        'secret_key',
        'api_doc_url',
    ];

    public $translatable = ['name', 'description'];

    const DELIVERY = 'Delivery';
    const PICKUP = 'PICKUP';
    const PICKUP_BY_CAR = 'PICKUP By Car';

    public function orders()
    {
        return $this->hasMany(Order::class);
    }


}
