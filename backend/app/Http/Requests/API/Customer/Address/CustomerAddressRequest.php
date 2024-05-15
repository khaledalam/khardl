<?php

namespace App\Http\Requests\API\Customer\Address;

use App\Enums\Customer\AddressesTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CustomerAddressRequest extends FormRequest
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
            'type' => ['required',new Enum(AddressesTypeEnum::class)],
            'address' => ['required','min:2','max:255'],
            'name' => ['nullable','min:2','max:255'],
            'lat' => ['nullable','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'lng' => ['nullable','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/']
        ];
    }
}
