<?php

namespace App\Http\Requests\Central\Advertisement;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AdvertisementPackageFormRequest extends FormRequest
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
        $rules = [
            'name.en' => 'required|string',
            'name.ar' => 'required|string',
            'description.en' => 'required|string',
            'description.ar' => 'required|string',
            'active' => ['required','boolean']
        ];
        if($this->advertisement){
            $rules['image'] = ['nullable','mimes:png,jpg,jpeg,gif,svg','max:4096'];
        }else{
            $rules['image'] = ['required','mimes:png,jpg,jpeg,gif,svg','max:4096'];
        }
        return $rules;
    }
}
