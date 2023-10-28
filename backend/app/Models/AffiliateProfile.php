<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsTo(User::class);
    }
}
