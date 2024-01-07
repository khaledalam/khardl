<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable = [
        "start_at",
        "end_at",
        'amount',
        "number_of_branches",
        "user_id",
        "chg_id",
        'cus_id',
        'payment_agreement_id'
    ];
}
