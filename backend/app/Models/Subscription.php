<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Subscription extends Model
{
    use HasTranslations;

    protected $table = 'subscriptions';

    protected $fillable = [
        'plan_name',
        'points',
        'price',
        'description'
    ];

    public $translatable = ['plan_name', 'description'];

    public function restaurantSubscribe()
    {
        return $this->hasMany(RestaurantSubscribe::class);
    }
}
