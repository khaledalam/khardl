<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;

class RestaurantStyle extends Model
{
    protected $table = 'restaurant_styles';

    protected $fillable = [
        'user_id',
        'logo',
        'logo_alignment',
        'category_style',
        'banner_image',
        'banner_images',
        'social_medias',
        'phone_number',
        'primary_color',
        'buttons_style',
        'images_style',
        'font_family',
        'font_type',
        'font_size',
        'button1_name',
        'button1_color',
        'button2_name',
        'button2_color',
        'login_logo'
    ];

    protected $casts = [
        'banner_images' => 'array',
        'social_medias' => 'array',
    ];

    /**
     * Get the user associated with this style.
     */
    public function user()
    {
        return $this->belongsTo(RestaurantUser::class);
    }
}
