<?php

namespace App\Http\Controllers\API\Tenant;

use App\Models\Tenant\RestaurantStyle;
use Illuminate\Http\Request;
use App\Traits\APIResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class RestaurantStyleController extends Controller
{
   use APIResponseTrait;

   public function save(Request $request){

        dd($request->all());
        $request->validate([
            'logo' => 'mimes:png,jpg,jpeg|max:2048',
            'logo_alignment' => 'required|string|in:Left,Right,Center',
            'category_style' => 'required|string|in:Tabs,Carousel,Right,Left', // category.selectedCategory
            'banner_style' => 'required|string|in:Slider,One Photo', // banner.selectedBanner
            'banner_image' => 'string', // One Phone
            'banner_images' => 'array', // Slider
            'social_medias' => 'array',
            'phone_number' => 'required|string',
            'primary_color',
            'buttons_style',
            'images_style',
            'font_family',
            'font_type',
            'font_size',
            'button1_name',
            'button1_color',
            'button2_name',
            'button2_color',
            'login_logo'
        ]);
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
