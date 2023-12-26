<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ROSubscription extends Model
{
    use HasFactory;
    protected $fillable =[
        'payment_agreement_id',
        'customer_id',
        'card_id',
        'amount',
        'status',
        'public_key',
        'secret_key'
    ];
    protected $casts = [
        'data'=>'array'
    ];
}
