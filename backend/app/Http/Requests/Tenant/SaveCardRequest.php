<?php

namespace App\Http\Requests\Tenant;

use App\Http\Requests\PhoneValidation;
use Illuminate\Foundation\Http\FormRequest;


class SaveCardRequest extends FormRequest
{
    
    public function authorize(){
        return true;
    }
    public function rules()
    {   
    

        return [
            'token_id' => 'required|string',
            'n_branches'=> 'required|integer',
            'type'=>'required|string',
    

        ];
    }
 

}
