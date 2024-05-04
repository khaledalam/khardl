<?php

namespace App\Http\Requests\Tenant;

use App\Http\Requests\PhoneValidation;
use Illuminate\Foundation\Http\FormRequest;


class   OTPCustomerAppRequest extends FormRequest
{
    use PhoneValidation;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rules= [
            'otp' => 'required|string',
            'id_sms'=>"required"
        ];
   
        return $rules;
    }
    protected function prepareForValidation(): void
    {
        $this->validatePhone();
    }
    
    
}
