<?php

namespace App\Http\Services\API\tenant;

use App\Models\Tenant\Branch;
use App\Models\Tenant\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\APIResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\RestaurantStyle;

class RestaurantStyleService
{
    use APIResponseTrait;

    public function save($request)
    {
        RestaurantStyle::updateOrCreate([
            'id' => 1
        ], $this->data($request));
        return $this->sendResponse(null, __('Restaurant style saved successfully.'));
    }
    private function data($request)
    {
        $data = [
            'id' => 1,
            'logo_alignment' => $request->logo_alignment,
            'logo_shape' => $request->logo_shape,
            'banner_type' => $request->banner_type,
            'banner_shape' => $request->banner_shape,
            'banner_background_color' => $request->banner_background_color,
            'category_shape' => $request->category_shape,
            'category_hover_color' => $request->category_hover_color,
            'category_alignment' => $request->category_alignment,
            'categoryDetail_type' => $request->categoryDetail_type,
            'categoryDetail_alignment' => $request->categoryDetail_alignment,
            'categoryDetail_shape' => $request->categoryDetail_shape,
            'categoryDetail_cart_color' => $request->categoryDetail_cart_color,
            'phoneNumber_alignment' => $request->phoneNumber_alignment,
            'phoneNumber' => $request->phoneNumber,
            'page_color' => $request->page_color,
            'page_category_color' => $request->page_category_color,
            'header_color' => $request->header_color,
            'headerPosition' => $request->headerPosition,
            'footer_color' => $request->footer_color,
            'price_color' => $request->price_color,
            'text_fontFamily' => $request->text_fontFamily,
            'text_fontWeight' => $request->text_fontWeight,
            'text_fontSize' => $request->text_fontSize,
            'text_alignment' => $request->text_alignment,
            'text_color' => $request->text_color,
            'product_background_color' => $request->product_background_color,
            'selectedSocialIcons' => $request->selectedSocialIcons,
            'user_id' => Auth::user()?->id,

            'menu_card_background_color' => $request->menu_card_background_color,
            'menu_card_text_font' => $request->menu_card_text_font,
            'menu_card_text_weight' => $request->menu_card_text_weight,
            'menu_card_text_size' => $request->menu_card_text_size,
            'menu_card_text_color' => $request->menu_card_text_color,
            'menu_card_radius' => $request->menu_card_radius,
            'menu_name_background_color' => $request->menu_name_background_color,
            'menu_name_text_font' => $request->menu_name_text_font,
            'menu_name_text_weight' => $request->menu_name_text_weight,
            'menu_name_text_size' => $request->menu_name_text_size,
            'menu_name_text_color' => $request->menu_name_text_color,
            'total_calories_background_color' => $request->total_calories_background_color,
            'total_calories_text_font' => $request->total_calories_text_font,
            'total_calories_text_weight' => $request->total_calories_text_weight,
            'total_calories_text_size' => $request->total_calories_text_size,
            'total_calories_text_color' => $request->total_calories_text_color,
            'price_background_color' => $request->price_background_color,
            'price_text_font' => $request->price_text_font,
            'price_text_weight' => $request->price_text_weight,
            'price_text_size' => $request->price_text_size,
            'price_text_color' => $request->price_text_color,
            'header_position' => $request->header_position,
            'header_radius' => $request->header_radius,
            'side_menu_position' => $request->side_menu_position,
            'order_cart_position' => $request->order_cart_position,
            'order_cart_color' => $request->order_cart_color,
            'order_cart_radius' => $request->order_cart_radius,
            'home_position' => $request->home_position,
            'home_color' => $request->home_color,
            'home_radius' => $request->home_radius,
            'menu_section_background_color' => $request->menu_section_background_color,
            'menu_section_radius' => $request->menu_section_radius,
            'menu_category_background_color' => $request->menu_category_background_color,
            'category_background_color' => $request->category_background_color,
            'menu_category_font' => $request->menu_category_font,
            'menu_category_weight' => $request->menu_category_weight,
            'menu_category_size' => $request->menu_category_size,
            'menu_category_color' => $request->menu_category_color,
            'menu_category_position' => $request->menu_category_position,
            'menu_category_radius' => $request->menu_category_radius,
            'footer_alignment' => $request->footer_alignment,
            'footer_text_fontFamily' => $request->footer_text_fontFamily,
            'footer_text_fontWeight' => $request->footer_text_fontWeight,
            'footer_text_fontSize' => $request->footer_text_fontSize,
            'footer_text_color' => $request->footer_text_color,
            'logo_border_radius' => $request->logo_border_radius,
            'logo_border_color' => $request->logo_border_color,

        ];
        if (isset($request->logo) && $request->logo) {
            $logo = tenant_asset(store_image($request->file('logo'), RestaurantStyle::STORAGE, 'logo'));
            $data['logo'] = $logo;
        }
        if (isset($request->banner_image) && $request->banner_image) {
            $banner_image = tenant_asset(store_image($request->file('banner_image'), RestaurantStyle::STORAGE, 'banner_image'));
            $data['banner_image'] = $banner_image;
        }
        if (isset($request->banner_images) && $request->banner_images) {
            foreach ($request->banner_images as $k => $image) {
                $banner_image = tenant_asset(store_image($image, RestaurantStyle::STORAGE, 'banner_image_' . $k + 1));
                $banner_images[] = $banner_image;

            }
            $data['banner_images'] = $banner_images;
        }

        return $data;
    }
    public function fetch($request)
    {
        $data = RestaurantStyle::first() ?? [];

        if ($data instanceof RestaurantStyle) {
            $data['buttons'] = [
                $data->left_side_button,
                $data->center_side_button,
                $data->right_side_button,
            ];

            $data->logo_url = $data->logo_url ?: $data->logo;

            $restaurant_name = '';
            tenancy()->central(function ($tenant) use (&$restaurant_name) {
                $restaurant_name = app()->getLocale() == 'en' ? $tenant->restaurant_name : $tenant->restaurant_name_ar;
            });

            $data->restaurant_name = $restaurant_name;

            // get branches of restaurant
            $data['branches'] = Branch::where('active',true)->get([
                'name',
                'id',
                'lat',
                'lng',
                'preparation_time_delivery',
                'pickup_availability',
                'drivers_option',
                'delivery_companies_option',
                'monday_open',
                'monday_close',
                'monday_closed',
                'tuesday_open',
                'tuesday_close',
                'tuesday_closed',
                'wednesday_open',
                'wednesday_close',
                'wednesday_closed',
                'thursday_open',
                'thursday_close',
                'thursday_closed',
                'friday_open',
                'friday_close',
                'friday_closed',
                'saturday_open',
                'saturday_close',
                'saturday_closed',
                'sunday_open',
                'sunday_close',
                'sunday_closed',
                'is_primary',
                'display_category_icon'
            ]);
        }

        return $this->sendResponse($data, __('Restaurant style fetched successfully.'));
    }
}
