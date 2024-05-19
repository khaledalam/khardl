<?php

namespace App\Http\Requests\Central\Advertisement;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateAdvertisementPackageRequest extends FormRequest
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
            'name.en' => 'required|string',
            'name.ar' => 'required|string',
            'description.en' => 'required|string',
            'description.ar' => 'required|string',
            'image' => ['required','mimes:png,jpg,jpeg,gif','max:4096'],
            'active' => ['required','boolean']
        ];
    }
}
