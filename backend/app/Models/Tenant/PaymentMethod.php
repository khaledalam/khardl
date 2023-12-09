<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{

    protected $table = 'payment_methods';

    protected $fillable = [
        'id',
        'name',
        'description',
        'icon',
        'is_active'
    ];

    public $translatable = ['description'];

    const CASH_ON_DELIVERY = 'Cash on delivery';
    const CREDIT_CARD = 'Credit card';
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
