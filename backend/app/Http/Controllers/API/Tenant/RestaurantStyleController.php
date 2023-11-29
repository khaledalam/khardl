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
        
        $request->validate([
            'logo' => 'required|mimes:png,jpg,jpeg|max:2048',
            'logo_alignment' => 'required|string|in:Left,Right,Center',
            'category_style' => 'required|string|in:Tabs,Carousel,Right,Left',
            'banner_style' => 'required|string|in:Slider,One Photo', 
            'banner_image' => 'required_if:banner_style,One Photo|nullable|mimes:png,jpg,jpeg|max:2048',
            'banner_images' => 'required_if:banner_style,Slider|nullable|array', 
            'banner_images.*' => 'mimes:png,jpg,jpeg|max:2048',
            'social_medias' => 'required|array',
            'social_medias.*.Link' => 'required|string',
            'phone_number' => 'required|string',
            'primary_color' => 'required|string',
            'buttons_style' => 'required|string',
            'images_style' => 'required|string',
            'font_family' => 'required|string',
            'font_type' => 'required|string',
            'font_size' => 'required|string',
            'font_alignment' => 'required|string',
            'left_side_button'=>'required|array',
            'right_side_button'=>'required|array',
            "center_side_button"=>'required|array',

        ]);
    
        $logo = store_image($request->file('logo'),RestaurantStyle::STORAGE,'logo');
        if($request->banner_image){
            $banner_image= store_image($request->file('banner_image'),RestaurantStyle::STORAGE,'banner_image');
        }else {
            foreach($request->banner_images as $k=>$image ){
                $banner_images[]= store_image($image,RestaurantStyle::STORAGE,'banner_image_'.$k+1);
            }
        }
        RestaurantStyle::updateOrCreate([
            'id'=>1
        ],[
            'id'=>1,
            'logo' => $logo ,
            'logo_alignment' => $request->logo_alignment,
            'category_style' => $request->category_style,
            'banner_style' => $request->banner_style,
            'banner_image' => isset($banner_image)?$banner_image: null,
            'banner_images' => (isset($banner_images))?json_encode($banner_images): null,
            'social_medias' =>  json_encode($request->social_medias),
            'phone_number' => $request->phone_number,
            'primary_color' => $request->primary_color,
            'buttons_style' => $request->buttons_style,
            'images_style' =>$request->images_style,
            'font_family' => $request->font_family,
            'font_type' =>$request->font_type,
            'font_size' => $request->font_size,
            'font_alignment' =>$request->font_alignment,
            'left_side_button'=>json_encode($request->left_side_button),
            'right_side_button'=>json_encode($request->right_side_button),
            "center_side_button"=>json_encode($request->center_side_button),
            'user_id'=> Auth::user()->id
        ]);

        return $this->sendResponse(null, __('Restaurant style saved successfully.'));

   }

    public function fetch(Request $request)
    {
        return $this->sendResponse(RestaurantStyle::first() ?? [], __('Restaurant style fetched successfully.'));
    }

}
