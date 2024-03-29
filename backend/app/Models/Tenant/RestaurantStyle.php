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

    public function getFileType($url)
    {
        $imageExtensions = ['png', 'jpg', 'jpeg','gif', 'webp'];
        $videoExtensions = ['mp4', 'avi', 'mov', 'wmv'];

        foreach ($imageExtensions as $imageExtension) {
            if (strpos($imageExtension,  $url) != false) {
                return 'image';
            }
        }

        foreach ($videoExtensions as $videoExtension) {
            if (strpos($videoExtension,  $url) != false) {
                return 'video';
            }
        }

        return 'image';

        // Default to 'unknown' or handle other types if needed
        return 'unknown';
    }

    public function getBannerImageAttribute()
    {
        $url = $this->attributes['banner_image'];

        $type = $this->getFileType($url);

//        if ($url) {
//            $url .= '?ver=' . random_hash();
//        }

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
