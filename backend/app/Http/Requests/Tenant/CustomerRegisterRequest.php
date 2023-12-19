<?php

namespace App\Http\Requests\Tenant;


use App\Http\Requests\PhoneValidation;
use Illuminate\Foundation\Http\FormRequest;


class CustomerRegisterRequest extends FormRequest
{
    use PhoneValidation;
    public function authorize(){
        return true;
    }
    public function rules()
    {

        return [
            'first_name' => 'required|string|min:3|max:255',
            'last_name' => 'required|string|min:3|max:255',
            'email' => 'nullable|string|email|min:10|max:255|unique:users',
            // 'password' => 'required|string|min:6|max:255',
            // 'c_password' => 'required|same:password',
            'phone' => 'required|regex:/^(966)?\d{9}$/|unique:users',
        ];
    }


    protected function prepareForValidation()
    {
        $this->validatePhone();
    }
    public function messages()
    {
        return [
            'phone.unique'=>__("Please use this phone to login in into your account")
        ];
    }
}
