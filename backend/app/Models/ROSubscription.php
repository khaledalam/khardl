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
        "chg_id",
        'cus_id',
        'payment_agreement_id',
        'status'
    ];
   
}
