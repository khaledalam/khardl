<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant\RestaurantStyle;
use Carbon\Carbon;
use App\Models\Tenant\Branch;
use Illuminate\Database\Seeder;

class RestaurantStyleSeeder extends Seeder
{

    public const BRANCH_ID = 1;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        return;

        // @TODO:

        $currentDateTime = Carbon::now();
        RestaurantStyle::create([
//            banner_image
//:
//"restaurant-styles/banner_image.png"
//banner_images
//:
//null
//banner_style
//:
//"One Photo"
//buttons_style
//:
//"0px"
//category_style
//:
//"Tabs"
//center_side_button
//:
//"{\"id\":\"2\",\"text\":\"Receipt\",\"color\":\"var(--primary)\",\"shape\":\"8px\"}"
//created_at
//:
//"2023-11-29T13:49:34.000000Z"
//font_alignment
//:
//"Center"
//font_family
//:
//"cairo"
//font_size
//:
//"15px"
//font_type
//:
//"normal"
//id
//:
//1
//images_style
//:
//"0px"
//left_side_button
//:
//"{\"id\":\"3\",\"text\":\"Login\",\"color\":\"var(--primary)\",\"shape\":\"8px\"}"
//logo
//:
//"restaurant-styles/logo.png"
//logo_alignment
//:
//"Center"
//phone_number
//:
//"+96600000000"
//primary_color
//:
//"var(--primary)"
//right_side_button
//:
//"{\"id\":\"1\",\"text\":\"delivery\",\"color\":\"var(--primary)\",\"shape\":\"8px\"}"
//social_medias
//:
//"[{\"id\":\"1\",\"name\":\"Whatsapp\",\"icon\":\"BsWhatsapp\",\"color\":\"Whatsapp\",\"Link\":\"test.com\"}]"
//updated_at
//:
//"2023-11-29T13:49:34.000000Z"
//user_id
//:
//5
        ]);





    }
}
