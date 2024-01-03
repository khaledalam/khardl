<?php

namespace App\Packages\TapPayment\Requests;

use LVR\CountryCode\Two;
use Illuminate\Foundation\Http\FormRequest;
use LVR\CountryCode\Three;

class CreateCardRequest  extends FormRequest
{
   /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'card.number'=>'required|integer',
            'card.exp_month'=>'required|integer',
            'card.exp_year'=>'required|integer',
            'card.cvc'=>'required|integer',
            'card.name'=>'required|string',
            'card.address'=>'nullable',
            'card.address.country'=>'nullable|string',
            'card.address.line1'=>'nullable|string',
            'card.address.city'=>'nullable|string',
            'card.address.street'=>'nullable|string',
            'card.address.avenue'=>'nullable|string',
            
            

        ];
    }
    
}