<?php

namespace Database\Seeders\Tenant;


use App\Models\Tenant\RestaurantStyle;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;

class RestaurantStyleSeeder extends Seeder
{
    public const RESTAURANT_STYLE_ID = 1;
    public const RESTAURANT_STYLE_SOCIAL_MEDIA_ID = 1;

    /**
     * Run the database seeds.
     */
    public function run($assets): void
    {
        // use public seeder folder
        $logo_file = new UploadedFile(public_path('assets/default_logo.png'), true);
        $logo = $assets . store_image($logo_file, RestaurantStyle::STORAGE, 'logo');

        $banner1_file = new UploadedFile(public_path('seeders/banner_1.jpeg'), true);
        $banner1 = $assets . store_image($banner1_file, RestaurantStyle::STORAGE, 'banner_1');

        $banner2_file = new UploadedFile(public_path('seeders/banner_2.jpg'), true);
        $banner2 = $assets . store_image($banner2_file, RestaurantStyle::STORAGE, 'banner_2');


        RestaurantStyle::create([
            'id' => self::RESTAURANT_STYLE_ID,
            'logo' => $logo,
            'logo_alignment' => 'center',
            'banner_image' => $banner1,
            'banner_images' => [
                // @TODO: handle banner_images tenant_asset() in seeder
                $banner1,
                $banner2
            ],
            'logo_shape' => 'rounded',
            'banner_type' => 'slider',
            'banner_shape' => 'rounded',
            'banner_background_color' => 'white',
            'category_shape' => 'rounded',
            'category_hover_color' => 'red',
            'category_alignment' => 'center',
            'categoryDetail_type' => 'stack',
            'categoryDetail_alignment' => 'center',
            'categoryDetail_shape' => 'rounded',
            'categoryDetail_cart_color' => 'green',
            'phoneNumber' => '+96600000000',
            'phoneNumber_alignment' => 'center',
            'page_color' => 'white',
            'page_category_color' => 'white',
            'headerPosition' => 'relative',
            'header_color' => 'white',
            'footer_color' => 'black',
            'price_color' => 'red',
            'text_fontFamily' => 'cairo',
            'text_fontWeight' => '300',
            'text_fontSize' => '15px',
            'text_alignment' => 'center',
            'text_color' => 'black',
            'product_background_color' => 'white',
            'selectedSocialIcons' => [
                [
                    'id' => self::RESTAURANT_STYLE_SOCIAL_MEDIA_ID,
                    'name' => "Whatsapp",
                    'imgUrl' => "https://cdn-icons-png.flaticon.com/128/5968/5968841.png",
                    'link' => "",
                ]
            ],
        ]);
    }
}
