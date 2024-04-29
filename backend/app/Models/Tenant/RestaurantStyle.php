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
    protected static function booted()
    {
        static::retrieved(function ($model) {
            $model->logo = self::changeImage($model->getAttributes()['logo']);       
        });
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

    public function getBannerImagesAttribute()
    {
        $values = null; 
        foreach(json_decode($this->attributes['banner_images']) as $image) {
            if (strpos($image, "http://") === 0 || strpos($image, "https://") === 0) {
                $url = '';
            }else {
                $url = tenant_route(tenant()->primary_domain->domain.'.'.config("tenancy.central_domains")[0],'home').'/tenancy/assets/'.$image;
            }
            if ($url) {
                $url .= '?ver=' . random_hash();
            }
            $values[]= [
                'url' => $url,
                'type' => $this->getFileType(
                    pathinfo(parse_url($this->attributes['banner_image'], PHP_URL_PATH), PATHINFO_EXTENSION)
                ),
            ];
        }
        return $values;
      

       
    }
    public function getBannerImageAttribute()
    {
        $url = $this->attributes['banner_image'];
        if (strpos($url, "http://") === 0 || strpos($url, "https://") === 0) {
            $url = '';
        }else {
            $url = tenant_route(tenant()->primary_domain->domain.'.'.config("tenancy.central_domains")[0],'home').'/tenancy/assets/'.$url;
        }
        if ($url) {
            $url .= '?ver=' . random_hash();
        }

        return [
            'url' => $url,
            'type' => $this->getFileType(
                pathinfo(parse_url($this->attributes['banner_image'], PHP_URL_PATH), PATHINFO_EXTENSION)
            ),
        ];
    }

   
    public static function changeImage($value){
        return  getImageFromTenant($value);
    }

       
}
