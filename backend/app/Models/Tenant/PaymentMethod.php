<?php

namespace App\Models\Tenant;

use Database\Factories\tenant\PaymentMethodFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;
    protected $table = 'payment_methods';

    public const PENDING = 'pending';
    public const PAID = 'paid';
    public const FAILED = 'failed';

    protected $fillable = [
        'id',
        'name',
        'description',
        'icon',

    ];

    public $translatable = ['description'];

    const CASH_ON_DELIVERY = 'Cash on Delivery';
    const ONLINE = 'Online';


    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    protected static function newFactory()
    {
      return PaymentMethodFactory::new();
    }
}
