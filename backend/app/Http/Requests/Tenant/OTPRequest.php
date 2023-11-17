<?php

namespace App\Http\Requests\Tenant;

use Illuminate\Foundation\Http\FormRequest;


class OTPRequest extends FormRequest
{
   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'otp' => [
                'required',
                'digits:4',
            ]
        ];
    }
    
    
}
