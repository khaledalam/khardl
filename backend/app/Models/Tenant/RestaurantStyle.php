<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;

class RestaurantStyle extends Model
{
    protected $table = 'restaurant_styles';

    protected $fillable = [
        'id',
        'user_id',
        'logo',
        'logo_alignment',
        'category_style',
        'banner_style',
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
        'font_alignment',
        'left_side_button',
        'right_side_button',
        'center_side_button',
    ];

    protected $casts = [
        'banner_images' => 'array',
        'social_medias' => 'array',
        'left_side_button' => 'array',
        'right_side_button' => 'array',
        'center_side_button' => 'array',
    ];
    const STORAGE = 'restaurant-styles';

    /**
     * Get the user associated with this style.
     */
    public function user()
    {
        return $this->belongsTo(RestaurantUser::class);
    }


    public function getLogoAttribute(){
        return tenant_asset($this->attributes['logo']);
    }

    public function getBannerImageAttribute(){
        return tenant_asset($this->attributes['banner_image']);
    }

}
