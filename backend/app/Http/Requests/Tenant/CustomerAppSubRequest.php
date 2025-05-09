<?php

namespace App\Http\Requests\Tenant;

use App\Http\Requests\PhoneValidation;
use Illuminate\Foundation\Http\FormRequest;


class CustomerAppSubRequest extends FormRequest
{
    
    public function authorize(){
        return true;
    }
    public function rules()
    {   
    

        return [
            'token_id' => 'required|string',
            'customer_app_sub_option'=>"required|in:is_lifetime_purchase,is_application_purchase"
        ];
    }
 

}
