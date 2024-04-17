<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerAppRequest extends FormRequest
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
            'android_url' => 'required_with_all:ios_url|nullable|url',
            'ios_url' => 'required_with_all:android_url|nullable|url',
            'icon'=>"nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240",
        ];
    }
  
}
