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
        ];
    }
 

}
