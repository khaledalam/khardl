<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantSetting extends Model
{
    protected $table = 'restaurant_settings';

    protected $fillable = [
        'key',
        'value',
        'description',
        'type'
    ];
}
