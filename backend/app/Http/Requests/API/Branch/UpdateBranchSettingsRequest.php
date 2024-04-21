<?php

namespace App\Http\Requests\API\Branch;

use App\Models\Tenant\RestaurantUser;
use App\Packages\DeliveryCompanies\DeliveryCompanies;
use App\Rules\UniqueSubdomain;
use App\Http\Requests\PhoneValidation;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBranchSettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'pickup_availability' => 'required_without_all:drivers_option,delivery_companies_option|boolean',
            'preparation_time_delivery'=>'nullable|date_format:"H:i:s"',
            'drivers_option' => ['nullable','boolean',function ($attribute, $value, $fail) {
                $hasActiveDrivers = RestaurantUser::activeDrivers()->get()->count();
                if($value == 1){
                    if(!$hasActiveDrivers){
                        $fail(__('Can not enable drivers option if you do not have active drivers.'));
                    }
                }
            }],
            'delivery_companies_option' => ['nullable','boolean',function ($attribute, $value, $fail) {
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
