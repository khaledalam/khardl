<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\RequiredIf;

class AddSubDiscountFormRequest extends FormRequest
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
            'promoter_id' => ['required'],
            'code' => ['required', 'string', 'max:100','unique:ro_subscription_coupons,code'],
            'type' => ['required', 'in:fixed,percentage'],
            'fixed' => [new RequiredIf($this->type == 'fixed'), 'min:1', 'nullable', 'numeric'],
            'percentage' => [new RequiredIf($this->type == 'percentage'), 'nullable', 'min:1', 'numeric', 'max:100'],
            'max_use' => ['nullable', 'min:0', 'integer'],
            'is_application_purchase' => ['nullable','boolean',new RequiredIf(!$this->is_branch_purchase)],
            'is_branch_purchase' => ['nullable','boolean',new RequiredIf(!$this->is_application_purchase)],
        ];
    }
}
