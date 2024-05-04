<?php

namespace App\Http\Requests;

use App\Http\Requests\PhoneValidation;
use Illuminate\Foundation\Http\FormRequest;

class VerifySMSRequest extends FormRequest
{
    use PhoneValidation;
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
        $user= getAuth();
        $rules= [
            'phone' => 'required|regex:/^(966)?\d{9}$/',
            'otp' => 'required|string',
            'id_sms'=>"required"
        ];
     
        if($user){
            $rules['phone'] .= '|unique:users,phone';
        }
        return $rules;
    }
    protected function prepareForValidation(): void
    {
        $this->validatePhone();
    }
  
}
