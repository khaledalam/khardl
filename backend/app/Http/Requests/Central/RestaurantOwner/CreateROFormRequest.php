<?php

namespace App\Http\Requests\Central\RestaurantOwner;

use App\Rules\UniqueSubdomain;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateROFormRequest extends FormRequest
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
        return [
            'restaurant_name' => ['required','string','min:3','max:255',new UniqueSubdomain()],
        ];
    }
}
