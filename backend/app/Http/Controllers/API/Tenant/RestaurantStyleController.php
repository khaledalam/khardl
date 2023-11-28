<?php

namespace App\Http\Controllers\API\Tenant;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\APIResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\RestaurantStyle;
use Illuminate\Support\Facades\Storage;


class RestaurantStyleController extends Controller
{
   use APIResponseTrait;

   public function save(Request $request){

       
        dd($request->all());
        $request->validate([
            'logo' => 'required|mimes:png,jpg,jpeg|max:2048',
            'logo_alignment' => 'required|string|in:Left,Right,Center',
            'category_style' => 'required|string|in:Tabs,Carousel,Right,Left',
            'banner_style' => 'required|string|in:Slider,One Photo', 
            'banner_image' => 'required_if:banner_style,One Photo|nullable|mimes:png,jpg,jpeg|max:2048',
            'banner_images' => 'required_if:banner_style,Slider|nullable|array', 
            'banner_images.*' => 'mimes:png,jpg,jpeg|max:2048',
            'social_medias' => 'array',
            'social_medias.*.Link' => 'string',
            'phone_number' => 'string',
            'primary_color' => 'string',
            'buttons_style' => 'string',
            'images_style' => 'string',
            'font_family' => 'string',
            'font_type' => 'string',
            'font_size' => 'string',
            'font_alignment' => 'string',
            'left_side_button'=>'array',
            'right_side_button'=>'array',
            "center_side_button"=>'array',

        ]);
        if($request->logo){
            logger(store_image($request->file('logo'),RestaurantStyle::STORAGE,'logo'));
        }
        if($request->banner_image){
            store_image($request->file('banner_image'),RestaurantStyle::STORAGE,'banner_image');

        }else {
            if($request->banner_images){
                foreach($request->banner_images as $k=>$image ){
                    store_image($image,RestaurantStyle::STORAGE,'banner_image_'.$k+1);
                }
            }
        }
        dd(1);
        $user = Auth::user();

        //@TODO: validate and save logic here

        return $this->sendResponse(null, __('Restaurant style saved successfully.'));

   }

    public function fetch(Request $request)
    {
        $user = Auth::user();

        $style = RestaurantStyle::
            where('user_id', $user?->id)
                ->first();

        return $this->sendResponse($style, __('Restaurant style fetched successfully.'));

    }

}
