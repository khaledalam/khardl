<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Subscription as CentralSubscription;
use App\Models\Tenant\RestaurantUser;
use Exception;

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
        'type',
        'reminder_email_sent',
        'reminder_suspend_email_sent',
        'subscription_id' // central subscription id
    ];
    //type
    public const NEW ="new";
    public const RENEW_TO_CURRENT_END_DATE ="renew_to_current_end_date";
    public const RENEW_FROM_CURRENT_END_DATE ="renew_from_current_end_date";
    public const RENEW_AFTER_ONE_YEAR ="one_year";
    public const TYPES = [
        self::NEW,
        self::RENEW_TO_CURRENT_END_DATE,
        self::RENEW_FROM_CURRENT_END_DATE,
        self::RENEW_AFTER_ONE_YEAR,
    ];
    // status
    public const ACTIVE = 'active';
    public const DEACTIVATE = 'deactivate';
    public const SUSPEND = 'suspend';
    // other status in tap payment status

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
    public function getDateLeftAttribute()
    {
        $diff=$this->start_at->diff($this->end_at);
        $monthsLeft = $diff->m + ($diff->y * 12);
        $daysLeft = $diff->d;
        $leftString = '';
        if ($monthsLeft > 0 && $daysLeft > 0) {
            $leftString = __(":monthsLeft months and :daysLeft days left",['monthsLeft'=>$monthsLeft,'daysLeft'=>$daysLeft]);
        } elseif ($monthsLeft > 0) {
            $leftString = __(":monthsLeft months left",['monthsLeft'=>$monthsLeft]);
        } elseif ($daysLeft > 0) {
            $leftString = __(":daysLeft left",['daysLeft'=>$daysLeft]);
        }
        return $leftString;
    }
    public function calculateDaysLeftCost($amount = null){
        $numberOfDays = $this->start_at->diffInDays($this->end_at);

        if($amount){
            $dailyCost = $amount / 365;
        }else {
            $dailyCost = $this->amount / 365;
        }


        return $numberOfDays * $dailyCost;
    }
    public static function serviceCalculate($type,$number_of_branches,$subscription_id,$json = false) {
        if(!in_array($type,self::TYPES)){
            throw new Exception("Subscription type npt find in the list");
        }
        $centralSubscription = tenancy()->central(function()use($subscription_id){
            return CentralSubscription::find($subscription_id);
        });
        $currentSubscription = ROSubscription::first();
       
        if ($currentSubscription) {
            if($type ==  self::RENEW_TO_CURRENT_END_DATE){
                $remainingDaysCost = $currentSubscription->calculateDaysLeftCost($centralSubscription->amount);
                $totalCost = $number_of_branches * $remainingDaysCost;
                $data = ['cost' => number_format($totalCost, 2),'number_of_branches'=>$number_of_branches];
                if($json)
                return response()->json($data);
                return $data;
            }
            // else if($type  ==  self::RENEW_FROM_CURRENT_END_DATE){
            //     $remainingDaysCost = $currentSubscription->calculateDaysLeftCost();
            //     $totalCost =$remainingDaysCost +  (($centralSubscription->amount * $number_of_branches) + $currentSubscription->amount);
            //     $data =   [
            //     'number_of_branches'=>$number_of_branches,
            //     'cost' => number_format($totalCost, 2),
            //     'remainingDaysCost'=>number_format($remainingDaysCost, 2),
            //     'newBranches'=>number_format(($centralSubscription->amount * $number_of_branches) + $currentSubscription->amount, 2)
            //     ];
            //     if($json)
            //     return response()->json($data);
            //     return $data;

            // }
            else if($type  ==  self::RENEW_AFTER_ONE_YEAR){
                $data =[ 'number_of_branches'=>$number_of_branches,'cost' => $currentSubscription->amount];
                if($json)
                return response()->json($data);
                return $data;

            }else {
                $data =[ ];
                if($json)
                return response()->json($data);
                return $data;
            }
        }else {
            // ROSubscription::NEW
            $data =[
                'cost'=> $centralSubscription->amount * $number_of_branches,
                'number_of_branches'=>$number_of_branches
             ];
            if($json)
            return response()->json($data);
            return $data;
        }

    }
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
