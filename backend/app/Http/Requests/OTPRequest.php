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
    public function verify($userSender,$otp)
    {
        if(!session()->get('otp_id')) return false;
        $otp = Msegat::verifyOTP(
                userSender: $userSender,
                otp: $otp,
                id: session()->get('otp_id')
        );
        if($otp['http_code'] == ResponseHelper::HTTP_OK){
            session()->remove("otp_id");
            return true;
        }
       return false;

    }

    
}
