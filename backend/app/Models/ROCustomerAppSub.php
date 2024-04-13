<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Tenant\RestaurantUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ROCustomerAppSub extends Model
{
    use HasFactory;
    protected $table ="r_o_customer_app_subs";
    protected $fillable =[
        'id',
        "start_at",
        "end_at",
        'amount',
        "user_id",
        'status',
        'reminder_email_sent',
        'reminder_suspend_email_sent',
        'subscription_id' 
    ];
    public function user(){
        return $this->belongsTo(RestaurantUser::class,'user_id');
    }
    public function getStartAtAttribute()
    {
        return Carbon::parse($this->attributes['start_at']);
    }
    public function getEndAtAttribute()
    {
        return Carbon::parse($this->attributes['end_at']);
    }
}
