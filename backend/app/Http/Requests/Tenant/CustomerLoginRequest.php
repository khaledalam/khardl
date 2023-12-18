<?php

namespace App\Http\Requests\Tenant;

use App\Models\User;
use App\Utils\ResponseHelper;
use Illuminate\Validation\Rule;
use App\Rules\PhoneIsAlreadyRegistered;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class CustomerLoginRequest extends FormRequest
{
    public function authorize(){
        return true;
    }
    public function rules()
    {

        return [
            'phone' => 'required|exists:users',
        ];
    }


    protected function prepareForValidation()
    {

        if ($this->phone) {
            // Remove any non-digit characters
            $cleanedPhone = preg_replace('/\D/', '', $this->phone);
            if (strlen($cleanedPhone) === 10) {
                // If it's 9 digits, merge with '966'
                $this->merge(['phone' => '966' . substr($cleanedPhone,1)]);
            } elseif (strlen($cleanedPhone) === 12 && substr($cleanedPhone, 0, 3) === '966') {
                // If it's 12 digits and starts with '966', keep it
                $this->merge(['phone' => $cleanedPhone]);
            }
        }
    }
}
