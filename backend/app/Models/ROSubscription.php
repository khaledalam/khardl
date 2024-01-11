<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        if ($monthsLeft > 0 && $daysLeft > 0) {
            $leftString = __(":monthsLeft months and :daysLeft days left",['monthsLeft'=>$monthsLeft,'daysLeft'=>$daysLeft]);
        } elseif ($monthsLeft > 0) {
            $leftString = __(":monthsLeft months left",['monthsLeft'=>$monthsLeft]);
        } elseif ($daysLeft > 0) {
            $leftString = __(":daysLeft left",['daysLeft'=>$daysLeft]);
        }
        return $leftString;
    }
}
