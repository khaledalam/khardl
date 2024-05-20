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
        $logo =  store_image($logo_file, RestaurantStyle::STORAGE, 'logo');

        $banner1_file = new UploadedFile(public_path('seeders/banner_1.jpeg'), true);
        $banner1 =  store_image($banner1_file, RestaurantStyle::STORAGE, 'banner_1');

        $banner2_file = new UploadedFile(public_path('seeders/banner_2.jpg'), true);
        $banner2 =  store_image($banner2_file, RestaurantStyle::STORAGE, 'banner_2');


        RestaurantStyle::create([
            'version' => generateToken(7),
            'id' => self::RESTAURANT_STYLE_ID,
            'logo' => $logo,
            'logo_alignment' => 'center',
            'banner_image' => $banner1,
            'banner_images' => [
                // @TODO: handle banner_images tenant_asset() in seeder
                // $banner1,
                // $banner2
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
            'page_color' => '#eee',
            'page_category_color' => '#ffffff',
            'logo_border_radius' => 25,
            'logo_border_color' => '#fff',
            'terms_and_conditions_enText' => '',
            'terms_and_conditions_arText' => '',
            'privacy_policy_enText' => '',
            'privacy_policy_arText' => '',
            'headerPosition' => 'relative',
            'banner_radius' => 20,
            'header_color' => '#ffffff',
            'footer_color' => '#ffffff',
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
            'menu_card_background_color' => '#FFECD61A',
            'menu_card_text_font' => 'Inter',
            'menu_card_text_weight' => 'light',
            'menu_card_text_size' => 13,
            'menu_card_text_color' => '#333',
            'menu_card_radius' => 20,
            'menu_name_background_color' => '#FFFFFF',
            'menu_name_text_font' => 'Inter',
            'menu_name_text_weight' => 'light',
            'menu_name_text_size' => 12,
            'menu_name_text_color' => '#000',
            'total_calories_background_color' => '#FFFFFF',
            'total_calories_text_font' => 'Inter',
            'total_calories_text_weight' => 'light',
            'total_calories_text_size' => 10,
            'total_calories_text_color' => '#000',
            'price_background_color' => '#7D0A0A',
            'price_text_font' => 'Inter',
            'price_text_weight' => 'light',
            'price_text_size' => 12,
            'price_text_color' => '#FFFFFF',
            'header_position' => 'relative',
            'header_radius' => 50,
            'side_menu_position' => 'left',
            'order_cart_position' => 'center',
            'order_cart_color' => '#ffffff',
            'order_cart_radius' => 50,
            'home_position' => 'right',
            'home_color' => '#ffffff',
            'home_radius' => 50,
            'menu_section_background_color' => '#ffffff',
            'menu_section_radius' => 50,
            'menu_category_background_color' => '#ffffff',
            'category_background_color' => '#4466ff',
            'menu_category_font' => 'Inter',
            'menu_category_weight' => 'light',
            'menu_category_size' => 13,
            'menu_category_color' => '#000000',
            'menu_category_position' => 'center',
            'menu_category_radius' => 20,
            'footer_alignment' => 'center',
            'footer_text_fontFamily' => 'Inter',
            'footer_text_fontWeight' => 'light',
            'footer_text_fontSize' => 10,
            'footer_text_color' => '#000000',
        ]);
    }
}
