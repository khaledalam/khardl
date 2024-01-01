<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ROSubscription extends Model
{
    use HasFactory;
    protected $table ="r_o_subscriptions";
    protected $fillable =[
        'customer_id',
        'card_id',
        'data',
        'amount',
        'status',
        'id',
        'public_key',
        'secret_key'
    ];
    protected $casts = [
        'data'=>'array'
    ];
}
