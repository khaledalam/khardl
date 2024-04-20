<?php

namespace App\Http\Requests\Tenant\Menu;

use App\Http\Requests\PhoneValidation;
use Illuminate\Foundation\Http\FormRequest;


class ItemFormRequest extends FormRequest
{
    public function authorize(){
        return true;
    }
    public function rules()
    {
        /* dd(request()->all()); */
        $rules = [
            'calories' => ['required','numeric'],
            'price' => ['required','numeric'],
            'item_name_en' => 'required|regex:/^[0-9a-zA-Z\s]+$/',
            'item_name_ar' => 'required|regex:/^[0-9\p{Arabic}\s]+$/u',
            'checkboxInputTitleAr' => ['array', function ($attribute, $titles, $fail)  {
                foreach ($titles as $key => $title) {
                    if(!isset($this->checkboxInputNameAr[$key])){
                        $fail(__('Options of title is required for Checkbox'));
                    }
                    if(is_array($this->checkboxInputNameAr[$key])){
                        foreach ($this->checkboxInputNameAr[$key] as $innerKey => $value) {
                            if(!isset($value) || $value == null){
                                $fail(__('Options[:num] name[AR] of checkbox can not be empty',['num' => $innerKey + 1]));
                            }
                        }
                    }else{
                        $fail(__('Options of title is required for Checkbox'));
                    }
                }
            }],
            'checkboxInputTitleEn' => ['array', function ($attribute, $titles, $fail)  {
                foreach ($titles as $key => $title) {
                    if(!isset($this->checkboxInputNameEn[$key])){
                        $fail(__('Options of title is required for Checkbox'));
                    }
                    if(!isset($this->checkboxInputPrice[$key])){
                        $fail(__('Prices is required for Checkbox'));
                    }
                    if(is_array($this->checkboxInputNameEn[$key])){
                        foreach ($this->checkboxInputNameEn[$key] as $innerKey => $value) {
                            if(!isset($value) || $value == null){
                                $fail(__('Options[:num] name[EN] of checkbox can not be empty',['num' => $innerKey + 1]));
                            }
                            if(!isset($this->checkboxInputPrice[$key][$innerKey]) || $this->checkboxInputPrice[$key][$innerKey] == null || $this->checkboxInputPrice[$key][$innerKey] < 0){
                                $fail(__('Price[:num] of checkbox can not be empty',['num' => $innerKey + 1]));
                            }
                        }
                    }else{
                        $fail(__('Options of title is required for Checkbox'));
                    }
                }
            }],
            'selectionInputTitleAr' => ['array', function ($attribute, $titles, $fail)  {
                foreach ($titles as $key => $title) {
                    if(!isset($this->selectionInputNameAr[$key])){
                        $fail(__('Options of title is required for Selection'));
                    }
                    if(is_array($this->selectionInputNameAr[$key])){
                        foreach ($this->selectionInputNameAr[$key] as $innerKey => $value) {
                            if(!isset($value) || $value == null){
                                $fail(__('Options[:num] name[AR] of selection can not be empty',['num' => $innerKey + 1]));
                            }
                            if(!isset($this->selectionInputPrice[$key][$innerKey]) || $this->selectionInputPrice[$key][$innerKey] == null || $this->selectionInputPrice[$key][$innerKey] < 0){
                                $fail(__('Price[:num] of selection can not be empty',['num' => $innerKey + 1]));
                            }
                        }
                    }else{
                        $fail(__('Options of title is required for Selection'));
                    }
                }
            }],
            'selectionInputTitleEn' => ['array', function ($attribute, $titles, $fail)  {
                foreach ($titles as $key => $title) {
                    if(!isset($this->selectionInputNameEn[$key])){
                        $fail(__('Options of title is required for Selection'));
                    }
                    if(is_array($this->selectionInputNameEn[$key])){
                        foreach ($this->selectionInputNameEn[$key] as $innerKey => $value) {
                            if(!isset($value) || $value == null){
                                $fail(__('Options[:num] name[EN] of selection can not be empty',['num' => $innerKey + 1]));
                            }
                        }
                    }else{
                        $fail(__('Options of title is required for Selection'));
                    }
                }
            }],
            'dropdownInputTitleAr' => ['array', function ($attribute, $titles, $fail)  {
                foreach ($titles as $key => $title) {
                    if(!isset($this->dropdownInputNameAr[$key])){
                        $fail(__('Options of title is required for Dropdown'));
                    }
                    if(is_array($this->dropdownInputNameAr[$key])){
                        foreach ($this->dropdownInputNameAr[$key] as $innerKey => $value) {
                            if(!isset($value) || $value == null){
                                $fail(__('Options[:num] name[AR] of dropdown can not be empty',['num' => $innerKey + 1]));
                            }
                            if(!isset($this->dropdownInputPrice[$key][$innerKey]) || $this->dropdownInputPrice[$key][$innerKey] == null || $this->dropdownInputPrice[$key][$innerKey] < 0){
                                $fail(__('Price[:num] of dropdown can not be empty',['num' => $innerKey + 1]));
                            }
                        }
                    }else{
                        $fail(__('Options of title is required for Dropdown'));
                    }
                }
            }],
            'dropdownInputTitleEn' => ['array', function ($attribute, $titles, $fail)  {
                foreach ($titles as $key => $title) {
                    if(!isset($this->dropdownInputNameEn[$key])){
                        $fail(__('Options of title is required for Dropdown'));
                    }
                    if(is_array($this->dropdownInputNameEn[$key])){
                        foreach ($this->dropdownInputNameEn[$key] as $innerKey => $value) {
                            if(!isset($value) || $value == null){
                                $fail(__('Options[:num] name[EN] of dropdown can not be empty',['num' => $innerKey + 1]));
                            }
                        }
                    }else{
                        $fail(__('Options of title is required for Dropdown'));
                    }
                }
            }]
        ];
        if($this->item){
            $rules['photo'] =  ['nullable','mimes:png,jpg,jpeg,gif','max:4096'];
        }else{
            $rules['photo'] =  ['required','mimes:png,jpg,jpeg,gif','max:4096'];
        }
        return $rules;
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
    public function validateOptions()
    {

    }
}
