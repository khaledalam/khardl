<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Packages\Msegat;
use App\Utils\ResponseHelper;
use Ichtrojan\Otp\Models\Otp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

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
                'numeric',
            ]
        ];
    }
    public function passedValidation(){
        if(!session('otp'.auth()->user()->id)){
            throw new ValidationException(
                new Validator (),
                ResponseHelper::response([
                    'message' => "User doesn't generate verification code",
                    'is_loggedin' => true,
                ], ResponseHelper::HTTP_UNPROCESSABLE_ENTITY)
            );
        }
    }


    
}
