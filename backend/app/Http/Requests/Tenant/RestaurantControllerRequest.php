<?php

namespace App\Http\Requests\Tenant;


use Closure;
use Illuminate\Validation\Rule;
use App\Http\Requests\PhoneValidation;
use App\Models\Tenant\RestaurantStyle;
use Illuminate\Foundation\Http\FormRequest;


class RestaurantControllerRequest extends FormRequest
{
    use PhoneValidation;
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        $restaurantStyles = RestaurantStyle::find(1);
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
            'headerPosition' => 'nullable|string|in:relative,fixed',
            'header_color' => 'nullable|string',
            'footer_color' => 'nullable|string',
            'price_color' => 'nullable|string',
            'selectedSocialIcons' => 'nullable|array',
            'text_fontFamily' => 'nullable|string',
            'text_fontWeight' => 'nullable|string|in:200,300,400,500,600,700,800',
            'text_fontSize' => 'nullable',
            'text_color' => 'nullable|string',
            /* OLD */
            'logo' => [
                Rule::when((!$restaurantStyles || !$restaurantStyles?->logo) && $this->logo == null, 'required|mimes:png,jpg,jpeg|max:2048')
            ],
            'banner_image' => [
                Rule::when(function ($attribute) use ($restaurantStyles) {
                    if (!$restaurantStyles && $attribute->banner_type == 'one-photo' && empty($attribute->banner_image)) {
                        return true;
                    } else {
                        if ($restaurantStyles->banner_image == null && $attribute->banner_type == 'one-photo' && empty($attribute->banner_image)) {
                            return true;
                        }
                    }
                }, 'required|mimes:png,jpg,jpeg|max:2048'),
            ],
            'banner_images' => [
                Rule::when(function ($attribute) use ($restaurantStyles) {
                    if (!$restaurantStyles && $attribute->banner_type == 'slider' && empty($attribute->banner_images)) {
                        return true;
                    } else {
                        if ($restaurantStyles->banner_images == null && $attribute->banner_type == 'slider' && empty($attribute->banner_images)) {
                            return true;
                        }
                    }
                }, 'required|array'),
            ],
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
            'phone.unique' => __("Please use this phone to login in into your account"),
        ];
    }
}
