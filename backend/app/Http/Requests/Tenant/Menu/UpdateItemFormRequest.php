<?php

namespace App\Http\Requests\Tenant\Menu;

use App\Http\Requests\PhoneValidation;
use Illuminate\Foundation\Http\FormRequest;


class UpdateItemFormRequest extends FormRequest
{
    public function authorize(){
        return true;
    }
    public function rules()
    {
        /* dd(request()->all()); */
        return [
            'calories' => ['required','numeric'],
            'price' => ['required','numeric'],
            'item_name_en' => 'required|regex:/^[0-9a-zA-Z\s]+$/',
            'item_name_ar' => 'required|regex:/^[0-9\p{Arabic}\s]+$/u',
            'checkboxInputTitleAr' => ['array', function ($attribute, $titles, $fail)  {
                foreach ($titles as $key => $title) {
                    if(!isset($this->checkboxInputNameAr[$key])){
                        $fail(__('Options of title :num is required for Checkbox',['num' => $key + 1]));
                    }
                }
            }],
            'checkboxInputTitleEn' => ['array', function ($attribute, $titles, $fail)  {
                foreach ($titles as $key => $title) {
                    if(!isset($this->checkboxInputNameEn[$key])){
                        $fail(__('Options of title :num is required for Checkbox',['num' => $key + 1]));
                    }
                }
            }],
            'selectionInputTitleAr' => ['array', function ($attribute, $titles, $fail)  {
                foreach ($titles as $key => $title) {
                    if(!isset($this->selectionInputNameAr[$key])){
                        $fail(__('Options of title :num is required for Selection',['num' => $key + 1]));
                    }
                }
            }],
            'selectionInputTitleEn' => ['array', function ($attribute, $titles, $fail)  {
                foreach ($titles as $key => $title) {
                    if(!isset($this->selectionInputNameEn[$key])){
                        $fail(__('Options of title :num is required for Selection',['num' => $key + 1]));
                    }
                }
            }],
            'dropdownInputTitleAr' => ['array', function ($attribute, $titles, $fail)  {
                foreach ($titles as $key => $title) {
                    if(!isset($this->dropdownInputNameAr[$key])){
                        $fail(__('Options of title :num is required for Dropdown',['num' => $key + 1]));
                    }
                }
            }],
            'dropdownInputTitleEn' => ['array', function ($attribute, $titles, $fail)  {
                foreach ($titles as $key => $title) {
                    if(!isset($this->dropdownInputNameEn[$key])){
                        $fail(__('Options of title :num is required for Dropdown',['num' => $key + 1]));
                    }
                }
            }]
        ];
    }
    public function messages()
    {
        return [
            'item_name_en.regex' => __("English name is not valid"),
            'item_name_en.required' => __("English name is required"),
            'item_name_ar.regex' => __("Arabic name is not valid"),
            'item_name_ar.required' => __("Arabic name is required")
        ];
    }
}
