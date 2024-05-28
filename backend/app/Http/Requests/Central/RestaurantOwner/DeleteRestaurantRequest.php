<?php

namespace App\Http\Requests\Central\RestaurantOwner;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRestaurantRequest extends FormRequest
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
            'password' => ['required',function($attribute,$value,$fail){
                if(env('DELETE_RESTAURANT_PASSWORD')==null || env('DELETE_RESTAURANT_PASSWORD') != $value){
                    $fail(__('Incorrect password.'));
                }
            }],
            'restaurant_name' => ['required',function($attribute,$value,$fail){
                if($value != $this->user->restaurant_name){
                    $fail(__('Incorrect restaurant name'));
                }
            }]
        ];
    }
}
