<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ROSubscription extends Model
{
    use HasFactory;
    protected $table ="r_o_subscriptions";
    protected $fillable =[
        'id',
        "start_at",
        "end_at",
        'amount',
        "number_of_branches",
        "user_id",
        'status',
        'subscription_id' // central subscription id
    ];

    public const ACTIVE = 'active';
    public const SUSPEND = 'suspend';
    // other status in tap payment status
   
}
