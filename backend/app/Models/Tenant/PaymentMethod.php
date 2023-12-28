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
    
    ];

    public $translatable = ['description'];

    const CASH_ON_DELIVERY = 'Cash on Delivery';
    const CREDIT_CARD = 'Credit Card';

    const YESWA_CORRESPOND_METHODS = [
        self::CASH_ON_DELIVERY=> 'COD',
        self::CREDIT_CARD=> 'PP',
    ];
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
