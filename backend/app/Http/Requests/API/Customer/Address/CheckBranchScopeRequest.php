<?php

namespace App\Http\Requests\API\Customer\Address;

use Illuminate\Foundation\Http\FormRequest;

class CheckBranchScopeRequest extends FormRequest
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
            'lat' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'lng' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/',function($attribute, $value, $fail){
                if($this->branch && !$this->branch?->lat || !$this->branch?->lng){
                   $fail(__('Can not determine the scope of the current branch'));
                }
            }]
        ];
    }
}
