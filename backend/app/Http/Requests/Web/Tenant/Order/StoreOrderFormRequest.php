<?php

namespace App\Http\Requests\Web\Tenant\Order;

use App\Http\Requests\PhoneValidation;
use App\Models\Tenant\Item;
use Illuminate\Foundation\Http\FormRequest;


class StoreOrderFormRequest extends FormRequest
{
    use PhoneValidation;
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'phone' => 'required|regex:/^(966)?\d{9}$/',
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'branch_id' => 'required|integer|exists:branches,id',
            'delivery_type_id' => 'required|integer|exists:delivery_types,id',
            'shipping_address' => 'required|max:255',
            'order_notes' => 'nullable|max:255',
            'products' => 'required|array',
            'products.*' => ['required', 'min:1'],
            'product_options' => ['nullable', 'array'],
            'product_options.*' => ['required', 'min:1'],
        ];
    }
    public function withValidator($validator)
    {
        foreach ($this->product_options ?? [] as $product => $options) {
            $item = Item::findOrFail($product);
            $validator->after(function ($validator) use ($item) {

                if ($item->checkbox_required) {
                    if (!$this->validateCheckboxOptions($validator, $item)) {
                        return;
                    }
                }
                if ($item->selection_required) {
                    if (!$this->validateRadioOptions($validator, $item)) {
                        return;
                    }
                }
                if ($item->dropdown_required) {
                    if (!$this->validateDropdownOptions($validator, $item)) {
                        return;
                    }
                }
            });
        }

    }

    public function validateCheckboxOptions($validator, $item)
    {
        $locale = app()->getLocale();
        foreach ($item->checkbox_required as $key => $option) {
            if ($option == 'true' && !isset($this->product_options[$item->id]['checkbox_input'][$key])) {
                $validator->errors()->add('selectedCheckbox', __(':option is required for :item', [
                    'option' => ($locale == 'en') ? $item->checkbox_input_titles[$key][0] : $item->checkbox_input_titles[$key][1],
                    'item' => $item->name
                ]));
                return false;
            }
            if (isset($this->checkbox_input[$key]) && (count($this->checkbox_input[$key]) > (int) $item->checkbox_input_maximum_choices[$key])) {
                $validator->errors()->add('selectedCheckbox', __('Maximum :option options for :item is ', [
                    'option' => ($locale == 'en') ? $item->checkbox_input_titles[$key][0] : $item->checkbox_input_titles[$key][1],
                    'item' => $item->name
                ]) . $item->checkbox_input_maximum_choices[$key]);
                return false;
            }
        }
        return true;
    }

    public function validateRadioOptions($validator, $item)
    {
        $locale = app()->getLocale();
        foreach ($item->selection_required as $key => $option) {
            if ($option == 'true' && !isset($this->product_options[$item->id]['selection_input'][$key])) {
                $validator->errors()->add('selectedRadio', __(':option is required for :item', [
                    'option' => ($locale == 'en') ? $item->selection_input_titles[$key][0] : $item->selection_input_titles[$key][1],
                    'item' => $item->name
                ]));
                return false;
            }
        }
        return true;
    }
    public function validateDropdownOptions($validator, $item)
    {
        $locale = app()->getLocale();
        foreach ($item->dropdown_required as $key => $option) {
            if ($option == 'true' && !isset($this->product_options[$item->id]['dropdown_input'][$key]) ?? false) {
                $validator->errors()->add('selectedDropdown', __(':option is required for :item', [
                    'option' => ($locale == 'en') ? $item->dropdown_input_titles[$key][0] : $item->dropdown_input_titles[$key][1],
                    'item' => $item->name
                ]));
                return false;
            }
        }
        return true;
    }
    protected function prepareForValidation()
    {
        $this->validatePhone();
    }
}
