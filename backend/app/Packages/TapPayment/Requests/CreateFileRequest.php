<?php

namespace App\Packages\TapPayment\Requests;

use LVR\CountryCode\Two;
use Illuminate\Foundation\Http\FormRequest;
use LVR\CountryCode\Three;

class CreateFileRequest  extends FormRequest
{
   /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
        ];
    }
    
}