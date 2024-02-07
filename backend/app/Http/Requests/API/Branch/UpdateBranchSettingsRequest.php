<?php

namespace App\Http\Requests\API\Branch;

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
            'delivery_availability' => 'required_without_all:preparation_time_delivery,pickup_availability|boolean',
            'pickup_availability' => 'required_without_all:delivery_availability,preparation_time_delivery|boolean',
            'preparation_time_delivery'=>'nullable|date_format:"H:i:s"'
        ];
    }
}
