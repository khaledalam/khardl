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
    public function run(): void
    {
        // use public seeder folder
        $logo_file = new UploadedFile(public_path('seeders/logo.png'), true);
        $logo = store_image($logo_file,RestaurantStyle::STORAGE,'logo');

        $banner1_file = new UploadedFile(public_path('seeders/banner_1.jpeg'), true);
        $banner1 = store_image($banner1_file,RestaurantStyle::STORAGE,'banner_1');

//        $banner2_file = new UploadedFile(public_path('seeders/banner_2.jpg'), true);
//        $banner2 = store_image($banner2_file,RestaurantStyle::STORAGE,'banner_2');


        RestaurantStyle::create([
            'id' => self::RESTAURANT_STYLE_ID,
            'logo' => $logo,
            'logo_alignment' => 'Center',
            'category_style' => 'Tabs',
            'banner_style' => 'One Photo',
            'banner_image' => $banner1,
            'banner_images' => [
                // @TODO: handle banner_images tenant_asset() in seeder
//                tenant_asset($banner1),
//                tenant_asset($banner2)
            ],
            'social_medias' => json_encode([
                'id' => self::RESTAURANT_STYLE_SOCIAL_MEDIA_ID,
                'name' => 'Whatsapp',
                'icon' => 'BsWhatsapp',
                'color' => 'Whatsapp',
                'Link' => '966666666'
            ]),
            'phone_number' => '+96600000000',
            'primary_color' => 'var(--primary)',
            'buttons_style' => '0px',
            'images_style' => '0px',
            'font_family' => 'cairo',
            'font_type' => 'normal',
            'font_size' => '15px',
            'font_alignment' => 'Center',
            'left_side_button' => json_encode(['id' => 3, 'text' => 'Login', 'color' => 'var(--primary)', 'shape' => '8px']),
            'right_side_button' => json_encode(['id' => 2, 'text' => 'delivery', 'color' => 'var(--primary)', 'shape' => '8px']),
            "center_side_button" => json_encode(['id' => 2, 'text' => 'Receipt', 'color' => 'var(--primary)', 'shape' => '8px']),
            'user_id' => null
        ]);
    }
}
