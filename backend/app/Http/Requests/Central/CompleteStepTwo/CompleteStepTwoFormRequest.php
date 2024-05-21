<?php

namespace App\Http\Requests\Central\CompleteStepTwo;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CompleteStepTwoFormRequest extends FormRequest
{

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
        return [
            'commercial_registration' => [
                'required',
                'mimes:pdf,jpg,jpeg,png',
                'max:25600',
                function ($attribute, $value, $fail) use ($user) {
                    // Check if the trader's registration requirements already fulfilled.
                    if ($user?->traderRegistrationRequirement && !$user->isRejected() && $user->restaurant !=null) {
                        $fail(__('You already completed register step2 successfully.'));
                    }
                }
            ], // 25MB
            'tax_registration_certificate' => 'nullable|mimes:pdf,jpg,jpeg,png|max:25600',
            'bank_certificate' => 'required|mimes:pdf,jpg,jpeg,png|max:25600',
            'identity_of_owner_or_manager' => 'required|mimes:pdf,jpg,jpeg,png|max:25600',
            'national_address' => 'required|mimes:pdf,jpg,jpeg,png|max:25600',

            'commercial_registration_number' => 'required|string|min:5|max:255',
            'IBAN' => 'required|string|min:10|max:255',
            'facility_name' => 'required|string|min:5|max:255',
            'national_id_number' => 'required|string|min:5|max:255',
            'dob' => 'required|date_format:Y-m-d'
        ];
    }
}
