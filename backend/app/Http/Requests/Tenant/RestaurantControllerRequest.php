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
            'logo_url' => 'nullable',
            'banner_image_url' => 'nullable',
            'banner_images_urls' => 'nullable',
            'banner_images_urls.*' => 'nullable',
            'phoneNumber' => 'required',
            'logo_alignment' => 'nullable|string|in:left,right,center',
            'phoneNumber_alignment' => 'nullable|string|in:left,right,center',
            'text_alignment' => 'nullable|string|in:left,right,center',
            'logo_shape' => 'nullable|string|in:rounded,sharp',
            'banner_type' => 'nullable|string|in:one-photo,slider',
            'banner_shape' => 'nullable|string|in:rounded,sharp',
            'banner_background_color' => 'nullable|string',
            'categoryDetail_type' => 'nullable|string|in:stack,grid',
            'category_shape' => 'nullable|string|in:rounded,sharp',
            'category_hover_color' => 'nullable|string',
            'category_alignment' => 'nullable|string|in:left,right,center',
            'categoryDetail_alignment' => 'nullable|string|in:left,right,center',
            'categoryDetail_shape' => 'nullable|string|in:rounded,sharp',
            'categoryDetail_cart_color' => 'nullable|string',
            'page_color' => 'nullable|string',
            'page_category_color' => 'nullable|string',
            'header_color' => 'nullable|string',
            'footer_color' => 'nullable|string',
            'price_color' => 'nullable|string',
            'selectedSocialIcons'   => 'nullable|array',
            'text_fontFamily' => 'nullable|string',
            'text_fontWeight' => 'nullable|numeric|in:200,300,400,500,600,700,800',
            'text_fontSize' => 'nullable',
            'text_color' => 'nullable|string',
            /* OLD */
            'logo' => 'required|mimes:png,jpg,jpeg|max:2048',
            'banner_image' => 'required_if:banner_type,one-photo|nullable|mimes:png,jpg,jpeg|max:2048',
            'banner_images' => 'required_if:banner_type,slider|nullable|array',
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
