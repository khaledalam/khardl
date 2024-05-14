<?php

namespace App\Http\Requests\Tenant\Menu;

use App\Http\Requests\PhoneValidation;
use Illuminate\Foundation\Http\FormRequest;


class ItemFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        /* dd(request()->all()); */
        $regexRules = [
            'item_name_en' => 'required|regex:/^[0-9a-zA-Z\s]+$/',
            'item_name_ar' => 'required|regex:/^[0-9\p{Arabic}\s]+$/u',
            'checkbox_input_maximum_choices' => 'nullable|int|min:1',
            'price_using_loyalty_points' => 'required_if:allow_buy_with_loyalty_points,1'
        ];
        $arabic_optional_text = ['checkboxInputNameAr', 'description_ar', 'selectionInputNameAr', 'dropdownInputNameAr'];
        $english_optional_text = ['checkboxInputNameEn', 'description_en', 'selectionInputNameEn', 'dropdownInputNameEn'];
        // @TODO: to be handled later
//        foreach ($arabic_optional_text as $field) {
//            if (request()->has($field) && request()->$field !=null) {
//                $regexRules[$field] = 'regex:/^[0-9\p{Arabic}\s]+$/u';
//            }
//        }
//        foreach ($english_optional_text as $field) {
//            if (request()->has($field) && request()->$field !=null) {
//                $regexRules[$field] = 'regex:/^[0-9a-zA-Z\s]+$/';
//            }
//        }
        $rules = [
            'calories' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'checkboxInputTitleAr' => [
                'array',
                function ($attribute, $titles, $fail) {
                    foreach ($titles as $key => $title) {
                        if (isset ($this->checkboxInputNameAr[$key]) && is_array($this->checkboxInputNameAr[$key])) {
                            foreach ($this->checkboxInputNameAr[$key] as $innerKey => $value) {
                                if (!isset ($value) || $value == null) {
                                    $fail(__('Options[:num] name[AR] of checkbox can not be empty', ['num' => $innerKey + 1]));
                                }
                            }
                        } else {
                            $fail(__('Options of title is required for Checkbox'));
                        }
                    }
                }
            ],
            'checkboxInputTitleEn' => [
                'array',
                function ($attribute, $titles, $fail) {
                    foreach ($titles as $key => $title) {
                        if (!isset ($this->checkboxInputPrice[$key])) {
                            $fail(__('Prices is required for Checkbox'));
                        }
                        if (isset ($this->checkboxInputNameEn[$key]) && is_array($this->checkboxInputNameEn[$key])) {
                            foreach ($this->checkboxInputNameEn[$key] as $innerKey => $value) {
                                if (!isset ($value) || $value == null) {
                                    $fail(__('Options[:num] name[EN] of checkbox can not be empty', ['num' => $innerKey + 1]));
                                }
                                if (!isset ($this->checkboxInputPrice[$key][$innerKey]) || $this->checkboxInputPrice[$key][$innerKey] == null || $this->checkboxInputPrice[$key][$innerKey] < 0) {
                                    $fail(__('Price[:num] of checkbox can not be empty', ['num' => $innerKey + 1]));
                                }
                            }
                        } else {
                            $fail(__('Options of title is required for Checkbox'));
                        }
                    }
                }
            ],
            'selectionInputTitleAr' => [
                'array',
                function ($attribute, $titles, $fail) {
                    foreach ($titles as $key => $title) {
                        if (isset ($this->selectionInputNameAr[$key]) && is_array($this->selectionInputNameAr[$key])) {
                            foreach ($this->selectionInputNameAr[$key] as $innerKey => $value) {
                                if (!isset ($value) || $value == null) {
                                    $fail(__('Options[:num] name[AR] of selection can not be empty', ['num' => $innerKey + 1]));
                                }
                                if (!isset ($this->selectionInputPrice[$key][$innerKey]) || $this->selectionInputPrice[$key][$innerKey] == null || $this->selectionInputPrice[$key][$innerKey] < 0) {
                                    $fail(__('Price[:num] of selection can not be empty', ['num' => $innerKey + 1]));
                                }
                            }
                        } else {
                            $fail(__('Options of title is required for Selection'));
                        }
                    }
                }
            ],
            'selectionInputTitleEn' => [
                'array',
                function ($attribute, $titles, $fail) {
                    foreach ($titles as $key => $title) {
                        if (isset ($this->selectionInputNameEn[$key]) && is_array($this->selectionInputNameEn[$key])) {
                            foreach ($this->selectionInputNameEn[$key] as $innerKey => $value) {
                                if (!isset ($value) || $value == null) {
                                    $fail(__('Options[:num] name[EN] of selection can not be empty', ['num' => $innerKey + 1]));
                                }
                            }
                        } else {
                            $fail(__('Options of title is required for Selection'));
                        }
                    }
                }
            ],
            'dropdownInputTitleAr' => [
                'array',
                function ($attribute, $titles, $fail) {
                    foreach ($titles as $key => $title) {
                        if (isset ($this->dropdownInputNameAr[$key]) && is_array($this->dropdownInputNameAr[$key])) {
                            foreach ($this->dropdownInputNameAr[$key] as $innerKey => $value) {
                                if (!isset ($value) || $value == null) {
                                    $fail(__('Options[:num] name[AR] of dropdown can not be empty', ['num' => $innerKey + 1]));
                                }
                                if (!isset ($this->dropdownInputPrice[$key][$innerKey]) || $this->dropdownInputPrice[$key][$innerKey] == null || $this->dropdownInputPrice[$key][$innerKey] < 0) {
                                    $fail(__('Price[:num] of dropdown can not be empty', ['num' => $innerKey + 1]));
                                }
                            }
                        } else {
                            $fail(__('Options of title is required for Dropdown'));
                        }
                    }
                }
            ],
            'dropdownInputTitleEn' => [
                'array',
                function ($attribute, $titles, $fail) {
                    foreach ($titles as $key => $title) {
                        if (isset ($this->dropdownInputNameEn[$key]) && is_array($this->dropdownInputNameEn[$key])) {
                            foreach ($this->dropdownInputNameEn[$key] as $innerKey => $value) {
                                if (!isset ($value) || $value == null) {
                                    $fail(__('Options[:num] name[EN] of dropdown can not be empty', ['num' => $innerKey + 1]));
                                }
                            }
                        } else {
                            $fail(__('Options of title is required for Dropdown'));
                        }
                    }
                }
            ]
        ];
        if ($this->item) {
            $rules['photo'] = ['nullable', 'mimes:png,jpg,jpeg,gif', 'max:4096'];
        } else {
            $rules['photo'] = ['required', 'mimes:png,jpg,jpeg,gif', 'max:4096'];
        }
        return array_merge($regexRules, $rules);
    }
    public function messages()
    {
        return [
            'item_name_en.regex' => __("English name is not valid"),
            'item_name_en.required' => __("English name is required"),
            'item_name_ar.regex' => __("Arabic name is not valid"),
            'item_name_ar.required' => __("Arabic name is required"),
            'description_en.regex' => __("English description is not valid"),
            'checkboxInputNameEn.regex' => __("English options is not valid"),
            'selectionInputNameEn.regex' => __("English options is not valid"),
            'dropdownInputNameEn.regex' => __("English options is not valid"),
            'description_ar.regex' => __("Arabic description is not valid"),
            'checkboxInputNameAr.regex' => __("Arabic options is not valid"),
            'selectionInputNameAr.regex' => __("Arabic options is not valid"),
            'dropdownInputNameAr.regex' => __("Arabic options is not valid"),
        ];
    }
    public function validateOptions()
    {

    }
}
