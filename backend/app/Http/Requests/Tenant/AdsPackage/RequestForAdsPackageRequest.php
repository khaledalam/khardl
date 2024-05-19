<?php

namespace App\Http\Requests\Tenant\AdsPackage;

use Illuminate\Foundation\Http\FormRequest;

class RequestForAdsPackageRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $package = $this->advertisement;
        return [
            'price' => ['required','min:1',function($attribute, $value, $fail) use($package){
                /* Check if pending request is already exist*/
                $ROUser = \App\Models\Tenant\RestaurantUser::find(1);
                $count = tenancy()->central(function () use ($ROUser,$package) {
                    $user = \App\Models\User::where('email', $ROUser->email)->first();
                    return \App\Models\AdsRequest::where('status','pending')
                    ->where('user_id',$user->id)
                    ->where('advertisement_package_id',$package)
                    ->count();
                });
                if($count){
                    $fail(__('You already have pending request for this service, please wait for the response'));
                }
            }]
        ];
    }



}
