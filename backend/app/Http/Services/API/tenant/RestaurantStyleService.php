<?php

namespace App\Http\Services\API\tenant;

use App\Models\Tenant\Branch;
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
        ],$this->data($request));
        return $this->sendResponse(null, __('Restaurant style saved successfully.'));
    }
    private function data($request){
        $logo = tenant_asset(store_image($request->file('logo'), RestaurantStyle::STORAGE, 'logo'));
        if($request->banner_image){
            $banner_image= tenant_asset(store_image($request->file('banner_image'),RestaurantStyle::STORAGE,'banner_image'));
        }else {
            if($request->banner_images){
                foreach($request->banner_images as $k=>$image ){
                    $banner_images[]= tenant_asset(store_image($image,RestaurantStyle::STORAGE,'banner_image_'.$k+1));
                }
            }
        }

        if($request->banner_images_urls){
            foreach($request->banner_images_urls as $k=>$image ){
                $banner_images_urls[]= $image;
            }
        }

        return [
            'id' => 1,
            'logo' => $logo,
            'logo_url' => $request->logo_url,
            'logo_alignment' => $request->logo_alignment,
            'banner_image' => isset($banner_image)?$banner_image: null,
            'banner_image_url' => $request->banner_image_url,
            'banner_images' => (isset($banner_images))?$banner_images: null,
            'banner_images_urls' => (isset($banner_images_urls))?$banner_images_urls: null,
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
            'phoneNumber' => $request->phoneNumber,
            'phoneNumber_alignment' => $request->phoneNumber_alignment,
            'page_color' => $request->page_color,
            'page_category_color' => $request->page_category_color,
            'header_color' => $request->header_color,
            'footer_color' => $request->footer_color,
            'price_color' => $request->price_color,
            'text_fontFamily' => $request->text_fontFamily,
            'text_fontWeight' => $request->text_fontWeight,
            'text_fontSize' => $request->text_fontSize,
            'text_alignment' => $request->text_alignment,
            'text_color' => $request->text_color,
            'selectedSocialIcons' => $request->selectedSocialIcons,
            'user_id' => Auth::user()->id
        ];
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

            // get branches of restaurant
            $data['branches'] = Branch::all(['name', 'id', 'lat', 'lng', 'delivery_availability', 'pickup_availability', 'preparation_time_delivery']);
        }

        return $this->sendResponse($data, __('Restaurant style fetched successfully.'));
    }
}
