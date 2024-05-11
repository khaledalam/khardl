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
        "start_at",
        "end_at",
        'amount',
        "user_id",
        "chg_id",
        'cus_id',
        'card_id',
        'icon',
        'status',
        'ios_url',
        'android_url',
        'reminder_email_sent',
        'reminder_suspend_email_sent',
        'subscription_id' ,
        'discount',
        'coupon_code'
    ];
    protected static function booted()
    {
        static::retrieved(function ($model) {
            $model->icon = self::changeIcon($model->icon);
        });
    }
    protected $appends = ['icon'];


    public const ACTIVE = 'active';
    public const DEACTIVATE = 'deactivate';
    public const SUSPEND = 'suspend';
    public const REQUESTED ='requested';

    public const LIFETIME_SUBSCRIPTION ="is_lifetime_purchase";

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
    public static function changeIcon($value){
        if(is_null($value)) return null;
        if (strpos($value, "http://") === 0 || strpos($value, "https://") === 0) {
            return $value;
        }else {
            return tenant_route(tenant()->primary_domain->domain.'.'.config("tenancy.central_domains")[0],'home').'/tenancy/assets/'.$value;
        }
    }
    public function getSubscriptionAttribute()
    {
        $subscription_id = $this->subscription_id;
        return tenancy()->central(function ($tenant) use ($subscription_id) {
            return Subscription::find($subscription_id);
        });
    }
}
