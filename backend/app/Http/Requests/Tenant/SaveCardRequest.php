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
        dd($this->all());
        return [
            'token_id' => ['required','string',
            function ($attribute, $value, $fail) {
                if($this->status != 'ACTIVE'){
                    $fail(__('You card is not active please try another one'));
                }
            }],
            'card_id' => 'required|string',
            'n_branches'=> 'required|integer',
            'type'=>'required|string'

        ];
    }
 

}
