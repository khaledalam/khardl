<?php

namespace App\Packages\TapPayment\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CreateCustomerRequest  extends FormRequest
{
   /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
public function rules()
    {
        return [
            'first_name' => 'required|string|min:3',
            'middle_name' => 'nullable|string|min:3',
            'last_name' => 'required|string|min:3',
            'email' => 'required|string|email|min:3',
            'phone.country_code' => 'required|string',
            'phone.number' => 'required|string',
            'currency'=>'required|string'
        ];
    }
    
}