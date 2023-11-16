<?php

namespace App\Http\Requests\Tenant;

use App\Models\User;
use App\Utils\ResponseHelper;
use Illuminate\Validation\Rule;
use App\Rules\PhoneIsAlreadyRegistered;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class CustomerRegisterRequest extends FormRequest
{
    public function authorize(){
        return true;
    }
    public function rules()
    {

        return [
            'first_name' => 'required|string|min:3|max:255',
            'last_name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|min:10|max:255|unique:users',
            'password' => 'required|string|min:6|max:255',
            'c_password' => 'required|same:password',
            'phone' => 'required|digits:12|unique:users',
            'terms_and_policies' => 'accepted',
        ];
    }


    protected function prepareForValidation()
    {
        if ($this->phone) {
            $this->merge(['phone' => '966'.$this->phone]);
        }
    }
}
