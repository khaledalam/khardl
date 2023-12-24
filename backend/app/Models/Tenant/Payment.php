<?php

namespace App\Models\Tenant;

use App\Models\Tenant\RestaurantUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    protected $table = 'payments';

    public const PENDING = 'pending';

    protected $fillable = [
        'order_id',
        'user_id',
        'transaction_id',
        'amount',
        'currency',
        'status',
        'method',
        'payment_date',
        'details'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(RestaurantUser::class);
    }
}
