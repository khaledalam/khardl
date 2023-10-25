<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Restaurant extends Model
{
    use HasTranslations;

    protected $table = 'restaurants';

    protected $fillable = [
        'name',
        'description',
        'subdomain',
        'address',
        'city',
        'state',
        'zipcode',
        'phone',
        'email',
        'website',
        'operating_hours',
        'operating_days',
        'close_message',
        'emergency_close_message',
        'lat',
        'lng',
        'status',
    ];

    public $translatable = ['name', 'description'];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public function subscriptions()
    {
        return $this->hasManyThrough(
            Subscription::class,
            RestaurantSubscribe::class,
            'restaurant_id',  // Foreign key on the restaurant_subscribe table...
            'id',             // Local key on the subscriptions table...
            'id',             // Local key on the restaurants table...
            'subscription_id' // Foreign key on the restaurant_subscribe table...
        );
    }

    public function restaurantSubscriptions()
    {
        return $this->hasMany(RestaurantSubscribe::class);
    }

    public function style()
    {
        return $this->hasOne(RestaurantStyle::class);
    }

}
