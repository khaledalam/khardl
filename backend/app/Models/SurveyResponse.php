<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'has_mobile_app',
        'has_delivery_system',
        'has_own_deliveries',
        'use_delivery_app',
        'sign_contract_with_delivery',
        'has_cashier_system',
        'use_order_app',
    ];
}
