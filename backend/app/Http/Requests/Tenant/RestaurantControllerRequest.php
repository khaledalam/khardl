<?php

namespace App\Http\Requests\Tenant;


use App\Http\Requests\PhoneValidation;
use Illuminate\Foundation\Http\FormRequest;


class RestaurantControllerRequest extends FormRequest
{
    use PhoneValidation;
    public function authorize(){
        return true;
    }
    public function rules()
    {
        return [
            /* New */
            'phoneNumber' => 'required',
            'logo_alignment' => 'required|string|in:left,right,center',
            'phoneNumber_alignment' => 'required|string|in:left,right,center',
            'text_alignment' => 'required|string|in:left,right,center',
            'logo_shape' => 'required|string|in:rounded,sharp',
            'banner_type' => 'required|string|in:one-page,slider',
            'banner_shape' => 'required|string|in:rounded,sharp',
            'banner_background_color' => 'required|string',
            'categoryDetail_type' => 'required|string|in:stack,grid',
            'category_shape' => 'required|string|in:rounded,sharp',
            'category_hover_color' => 'required|string',
            'category_alignment' => 'required|string|in:left,right,center',
            'categoryDetail_alignment' => 'required|string|in:left,right,center',
            'categoryDetail_shape' => 'required|string|in:rounded,sharp',
            'categoryDetail_cart_color' => 'required|string',
            'page_color' => 'required|string',
            'page_category_color' => 'required|string',
            'header_color' => 'required|string',
            'footer_color' => 'required|string',
            'price_color' => 'required|string',
            'selectedSocialIcons'   => 'required|array',
            'text_fontFamily' => 'required|string',
            'text_fontWeight' => 'required|in:bold,400,700,300',
            'text_fontSize' => 'required',
            'text_color' => 'required|string',
            /* OLD */
            'logo' => 'required|mimes:png,jpg,jpeg|max:2048',
            'banner_image' => 'required_if:banner_style,One Photo|nullable|mimes:png,jpg,jpeg|max:2048',
            'banner_images' => 'required_if:banner_style,Slider|nullable|array',
            'banner_images.*' => 'mimes:png,jpg,jpeg|max:2048',
        ];
    }


    protected function prepareForValidation()
    {
        $this->validatePhone();
    }
    public function messages()
    {
        return [
            'phone.unique'=>__("Please use this phone to login in into your account"),
        ];
    }
}
