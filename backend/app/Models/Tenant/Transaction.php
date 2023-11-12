<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsTo(User::class);
    }

    /**
     * A transaction may be associated with a payment.
     */
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
