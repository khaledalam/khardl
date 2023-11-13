<?php

namespace App\Models\Tenant;

use App\Models\Tenant\RestaurantUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AffiliateProfile extends Model
{
    protected $table = 'affiliate_profiles';

    protected $fillable = [
        'user_id',
        'commission_rate',
        'referral_code',
        'referral_link',
        'total_earned',
        'status',
        'payment_details'
    ];


    public function user()
    {
        return $this->belongsTo(RestaurantUser::class);
    }
}
