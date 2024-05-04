<?php

namespace App\Http\Requests\Tenant;

use App\Http\Requests\PhoneValidation;
use Illuminate\Foundation\Http\FormRequest;


class CustomerAppLoginRequest extends FormRequest
{
    use PhoneValidation;
    public function authorize(){
        return true;
    }
    public function rules()
    {
        return [
            'phone' => 'required|exists:users',
            'otp' => [
                'required',
                'digits:4',
            ],
            'id_sms' =>  'required|string'
        ];
    }


    protected function prepareForValidation()
    {
        $this->validatePhone();
    }
    public function messages()
    {
        return [
            'phone.exists' => __("Phone number is not exist"),
        ];
    }
}
