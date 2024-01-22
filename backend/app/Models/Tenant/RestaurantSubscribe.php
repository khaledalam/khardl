<?php

namespace App\Models\Tenant;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantSubscribe extends Model
{
    protected $table = 'restaurant_subscribes';

    protected $fillable = [
        'restaurant_id',
        'subscription_id',
        'start_date',
        'end_date',
        'is_active'
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
