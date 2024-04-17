<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ROCustomerAppSubInvoice extends Model
{
    use HasFactory;
    protected $table ="r_o_customer_app_sub_invoices";
    protected $fillable =[
        'id',
        'amount',
        "user_id",
        "chg_id",
        'cus_id',
        'card_id',
        'status',
        'subscription_id'
    ];
}
