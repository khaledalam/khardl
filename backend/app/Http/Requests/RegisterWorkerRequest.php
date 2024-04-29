<?php

namespace App\Http\Requests;

use App\Rules\UniqueSubdomain;
use App\Http\Requests\PhoneValidation;
use Illuminate\Foundation\Http\FormRequest;

class RegisterWorkerRequest extends FormRequest
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
        $rules= [
            'first_name' => 'required|string|min:3|max:255',
            'last_name' => 'required|string|min:3|max:255',
            'password' => 'required|string|min:6|max:255',
           
            'can_modify_and_see_other_workers' => 'boolean',
            'can_modify_working_time' => 'boolean',
            'can_edit_menu' => 'boolean',
            'can_control_payment' => 'boolean',
            'can_view_revenues' => 'boolean',
            'can_edit_and_view_drivers' => 'boolean',
            'at_least_one_permission' => 'required_without_all:can_modify_and_see_other_workers,can_modify_working_time,can_edit_menu,can_control_payment,can_view_revenues,can_edit_and_view_drivers',
        ];
        if($this->id){
            $rules['email'] =  'required|string|email|min:10|max:255|unique:users,email,'.$this->id;
            $rules['phone'] =  'required|regex:/^(966)?\d{9}$/|unique:users,phone,'.$this->id;
        }else {
            $rules['email'] =  'required|string|email|min:10|max:255|unique:users';
            $rules['phone'] =  'required|regex:/^(966)?\d{9}$/|unique:users';
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'at_least_one_permission.required_without_all'=>__("at least one permission required")
        ];
    }
    protected function prepareForValidation()
    {
        $this->validatePhone();
    }
}
