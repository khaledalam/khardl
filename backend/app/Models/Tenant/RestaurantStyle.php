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

    public function getFileType($extension)
    {
        $imageExtensions = ['png', 'jpg', 'jpeg','gif', 'webp'];
        $videoExtensions = ['mp4', 'avi', 'mov', 'wmv'];

        if (in_array($extension, $imageExtensions)) {
            return 'image';
        } elseif (in_array($extension, $videoExtensions)) {
            return 'video';
        }

        // Default to 'unknown' or handle other types if needed
        return 'unknown';
    }

    public function getBannerImageAttribute()
    {
        $url = $this->attributes['banner_image'];

        $type = $this->getFileType(pathinfo($url, PATHINFO_EXTENSION));

        if ($url) {
            $url .= '?ver=' . random_hash();
        }

        return [
            'url' => $url,
            'type' => $type,
        ];
    }

    public function getBannerImagesAttribute()
    {
        $images = [];
        foreach (json_decode($this->attributes['banner_images']) as $image) {

            $new['type'] = $this->getFileType(pathinfo($image, PATHINFO_EXTENSION));

//            if ($image) {
//                $image .= '?ver=' . random_hash();
//            }
            $new['url'] = $image;
            $images[] = $new;
        }
        return $images;
    }


}
