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
            'email' => 'nullable|string|email|min:10|max:255|unique:users',
            // 'password' => 'required|string|min:6|max:255',
            // 'c_password' => 'required|same:password',
            'phone' => 'required|regex:/^(966)?\d{10}$/|unique:users',
            'terms_and_policies' => 'accepted',
        ];
    }


    protected function prepareForValidation()
    {
        if ($this->phone) {
            // Remove any non-digit characters
            $cleanedPhone = preg_replace('/\D/', '', $this->phone);
            if (strlen($cleanedPhone) === 10) {
                // If it's 9 digits, merge with '966'
                $this->merge(['phone' => '966' . $cleanedPhone]);
            } elseif (strlen($cleanedPhone) === 12 && substr($cleanedPhone, 0, 3) === '966') {
                // If it's 12 digits and starts with '966', keep it
                $this->merge(['phone' => $cleanedPhone]);
            }
        }
    }
}
