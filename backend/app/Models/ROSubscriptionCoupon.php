<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ROSubscriptionCoupon extends Model
{
    use HasFactory;
protected $table ='ro_subscription_coupons';
    protected $guarded = [];
    public function promoter(){
        return $this->belongsTo(Promoter::class);
    }
}
