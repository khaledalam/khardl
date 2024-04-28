<?php

namespace App\Http\Requests\Tenant\BranchSettings;


use App\Models\Tenant\Item;
use App\Models\Tenant\RestaurantUser;
use App\Packages\DeliveryCompanies\DeliveryCompanies;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBranchSettingFromRequest extends FormRequest
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
        return [
            'payment_methods' => ['required','array'],
            'payment_methods.*' => ['required', 'min:1', 'in:Online,Cash on Delivery'],
            'preparation_time_delivery'=>'nullable|date_format:"H:i:s"',
            'pickup_availability' => 'required_without_all:drivers_option,delivery_companies_option|boolean',
            'drivers_option' => ['nullable', function ($attribute, $value, $fail) {
                $hasActiveDrivers = RestaurantUser::activeDrivers()->get()->count();
                if($value == 1){
                    if(!$hasActiveDrivers){
                        $fail(__('Can not enable drivers option if you do not have active drivers.'));
                    }
                }
            }],
            'delivery_companies_option' => ['nullable', function ($attribute, $value, $fail) {
                $hasDeliveryCompanies = DeliveryCompanies::all()->count();
                if($value == 1){
                    if(!$hasDeliveryCompanies){
                        $fail(__('Can not enable delivery company option if you do not signed with any delivery company.'));
                    }
                }
            }]
        ];
    }



}
