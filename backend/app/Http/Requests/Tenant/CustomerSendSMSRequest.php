<?php

namespace App\Http\Requests\Tenant;

use App\Http\Requests\PhoneValidation;
use Illuminate\Foundation\Http\FormRequest;


class CustomerSendSMSRequest extends FormRequest
{
    use PhoneValidation;
    public function authorize(){
        return true;
    }
    public function rules()
    {
        $user= getAuth();

        $rules= [
            'phone' => 'required|regex:/^(966)?\d{9}$/',
        ];
        if($user){
            $rules['phone'] .= '|unique:users,phone';
        }

        return $rules;
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
