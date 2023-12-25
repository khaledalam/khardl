<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;

class RestaurantStyle extends Model
{
    protected $table = 'restaurant_styles';

    protected $guarded = [];

    protected $casts = [
        'banner_images' => 'array',
        'selectedSocialIcons' => 'array',
    ];
    const STORAGE = 'restaurant-styles';

    /**
     * Get the user associated with this style.
     */
    public function user()
    {
        return $this->belongsTo(RestaurantUser::class);
    }




}
