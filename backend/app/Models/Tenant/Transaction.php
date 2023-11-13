<?php

namespace App\Models\Tenant;

use App\Models\Tenant\RestaurantUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'user_id',
        'payment_id',
        'transaction_type',
        'amount',
        'currency',
        'status',
        'transaction_date',
        'external_reference',
        'details'
    ];

    /**
     * A transaction belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(RestaurantUser::class);
    }

    /**
     * A transaction may be associated with a payment.
     */
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
