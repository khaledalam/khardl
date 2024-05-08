<?php

namespace App\Http\Services\API\tenant;

use App\Http\Resources\RestaurantStyleAppResource;
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
            'version' => generateToken(7),
            'id' => 1,
            'logo_alignment' => $request->logo_alignment,
            'logo_shape' => $request->logo_shape,
            'banner_type' => $request->banner_type,
            'banner_shape' => $request->banner_shape,
            'banner_background_color' => $request->banner_background_color,
            'user_id' => Auth::user()?->id,
        ];
        $properties = [
            'category_shape',
            'category_hover_color',
            'category_hover_color',
            'category_alignment',
            'categoryDetail_type',
            'categoryDetail_alignment',
            'categoryDetail_shape',
            'categoryDetail_cart_color',
            'phoneNumber_alignment',
            'phoneNumber',
            'page_category_color',
            'headerPosition',
            'footer_color',
            'price_color',
            'text_fontFamily',
            'text_fontWeight',
            'text_fontSize',
            'text_alignment',
            'text_color',
            'product_background_color',
            'selectedSocialIcons',
            'page_color',
            'banner_radius',
            'menu_card_text_color',
            'menu_card_radius',
            'menu_card_text_size',
            'menu_name_background_color',
            'menu_name_text_font',
            'menu_name_text_weight',
            'menu_name_text_size',
            'menu_name_text_color',
            'menu_card_background_color',
            'total_calories_background_color',
            'total_calories_text_font',
            'total_calories_text_weight',
            'total_calories_text_size',
            'total_calories_text_color',
            'price_background_color',
            'price_text_font',
            'price_text_weight',
            'price_text_size',
            'price_text_color',
            'header_position',
            'header_color',
            'header_radius',
            'side_menu_position',
            'order_cart_position',
            'order_cart_color',
            'order_cart_radius',
            'home_position',
            'home_color',
            'home_radius',
            'menu_section_background_color',
            'menu_section_radius',
            'menu_category_font',
            'menu_category_weight',
            'menu_category_size',
            'menu_category_color',
            'menu_category_position',
            'menu_category_radius',
            'page_color',
            'category_background_color',
            'page_category_color',
            'product_background_color',
            'footer_color',
            'footer_alignment',
            'footer_text_fontFamily',
            'footer_text_fontWeight',
            'footer_text_fontSize',
            'footer_text_color',
            'price_color',
            'logo_border_radius',
            'logo_border_color',
            'terms_and_conditions_enText',
            'terms_and_conditions_arText',
            'privacy_policy_enText',
            'privacy_policy_arText',
        ];

        foreach ($properties as $property) {
            if (isset($request->$property) && $request->$property !== null) {
                $data[$property] = $request->$property;
            }
        }
        if (isset($request->logo) && $request->logo) {
            $logo = store_image($request->file('logo'), RestaurantStyle::STORAGE, 'logo');
            $data['logo'] = $logo;
        }
        if (isset($request->banner_image) && $request->banner_image) {
            $banner_image = store_image($request->file('banner_image'), RestaurantStyle::STORAGE, 'banner_image');
            $data['banner_image'] = $banner_image;
        }
        if (isset($request->banner_images) && $request->banner_images) {
            foreach ($request->banner_images as $k => $image) {
                $banner_image = store_image($image, RestaurantStyle::STORAGE, 'banner_image_' . $k + 1);
                $banner_images[] = $banner_image;

            }
            $data['banner_images'] = $banner_images;
        }

        if (!isset($request->selectedSocialIcons)) {
            $data['selectedSocialIcons'] = [];
        }

        return $data;
    }
    public function appendIfExists($key, $data)
    {
        if (isset($key) && $key != null) {
            $data[$key] = $key;
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
            $data['branches'] = Branch::where('active', true)->get([
                'name',
                'phone',
                'city',
                'neighborhood',
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
    public function fetchToApp($request)
    {
        return new RestaurantStyleAppResource(RestaurantStyle::first());
    }
}
