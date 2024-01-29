<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ROSubscriptionInvoice extends Model
{
    use HasFactory;
    protected $table ="r_o_subscription_invoices";
    protected $fillable =[
        'id',
        'amount',
        "number_of_branches",
        "user_id",
        "chg_id",
        'cus_id',
        'card_id',
        'status',
        'type',
        'subscription_id' // central subscription id
    ];
    /* Start Relations */
    public function getSubscriptionAttribute()
    {
        $subscription_id = $this->subscription_id;
        return tenancy()->central(function ($tenant) use ($subscription_id) {
            return Subscription::find($subscription_id);
        });
    }
    /* End Relations */
}
