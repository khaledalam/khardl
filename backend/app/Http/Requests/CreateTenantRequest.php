<?php

namespace App\Http\Requests;

use App\Utils\ResponseHelper;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class CreateTenantRequest extends FormRequest
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
            'domain' => 'required|string|unique:domains',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:tenants',
            'password' => 'required|string|max:255',
        ];
    }
    public function passedValidation(){
        $this->replace(['password'=>bcrypt($this->password)]);
    }
    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException(
            $validator,
            ResponseHelper::response([
                'message' => $validator->errors()->first(),
                'is_loggedin' => true,
                ], ResponseHelper::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
