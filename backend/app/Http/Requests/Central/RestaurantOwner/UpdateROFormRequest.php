<?php

namespace App\Http\Requests\Central\RestaurantOwner;

use App\Http\Requests\PhoneValidation;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateROFormRequest extends FormRequest
{
    use PhoneValidation;

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = $this->user;
        $hasFiles = $user->traderRegistrationRequirement()->exists();
        $ROInfoRules = [
            'first_name' => 'required|string|min:3|max:255',
            'last_name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|min:10|max:255|unique:users,email,' . $this->user?->id,
            'position' => 'required|string|min:3|max:255',
            'password' => 'nullable|string|min:6|max:255',
            'phone' => 'required|regex:/^(966)?\d{9}$/|unique:users,phone,' . $this->user?->id,
        ];
        $TraderRequirementsRules = [
            'commercial_registration' => [
                'nullable',
                'mimes:pdf,jpg,jpeg,png',
                'max:25600',
            ], // 25MB
            'tax_registration_certificate' => 'nullable|mimes:pdf,jpg,jpeg,png|max:25600',
            'bank_certificate' => 'nullable|mimes:pdf,jpg,jpeg,png|max:25600',
            'identity_of_owner_or_manager' => 'nullable|mimes:pdf,jpg,jpeg,png|max:25600',
            'national_address' => 'nullable|mimes:pdf,jpg,jpeg,png|max:25600',
            'commercial_registration_number' => 'required|string|min:5|max:255',
            'IBAN' => 'required|string|min:10|max:255',
            'facility_name' => 'required|string|min:5|max:255',
            'national_id_number' => 'required|string|min:5|max:255',
            'dob' => 'required|date_format:Y-m-d'
        ];
        if($hasFiles){
            return array_merge($TraderRequirementsRules,$ROInfoRules);
        }else{
            return $ROInfoRules;
        }
    }

    protected function prepareForValidation()
    {
        $this->validatePhone();
    }
}
