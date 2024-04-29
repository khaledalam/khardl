<?php

namespace App\Http\Requests\Tenant;

use App\Http\Requests\PhoneValidation;
use Illuminate\Foundation\Http\FormRequest;


class RenewBranchRequest extends FormRequest
{
    
    public function authorize(){
        return true;
    }
    public function rules()
    {   
    

        return [
            'token_id' => 'required|string',
            'currentBranch'=> 'required|integer',
    
    

        ];
    }
 

}
