<?php

namespace App\Http\Requests\Tenant\Customer;


use App\Models\Tenant\Item;
use Illuminate\Foundation\Http\FormRequest;

class AddItemToCartRequest extends FormRequest
{

    protected $stopOnFirstFailure = true;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'item_id' => 'required|int',
            'quantity' => 'required|int|min:1',
            'branch_id'=>'required|int',
            'notes' => 'nullable|string',
            'selectedCheckbox'=> 'nullable',
            'selectedRadio'=> 'nullable',
            'selectedDropdown'=> 'nullable',
        ];
    }

    public function withValidator($validator)
    {
        $item = Item::findOrFail($this->item_id);
        $validator->after(function ($validator)use($item) {

            if($item->checkbox_required){
                if(!$this->validateCheckboxOptions($validator,$item)){
                    return ;
                }
            }
            if($item->selection_required){
                if(!$this->validateRadioOptions($validator,$item)){
                    return ;
                }
            }
            if($item->dropdown_required){
                if(!$this->validateDropdownOptions($validator,$item)){
                    return ;
                }
            }
        });
    }

    public function validateCheckboxOptions($validator,$item){
        $locale =  app()->getLocale();
        foreach($item->checkbox_required as $key=>$option){
            if($option == 'true' && !isset($this->selectedCheckbox[$key])  ) {
                $validator->errors()->add('selectedCheckbox', __(':option is required',['option'=>($locale == 'en' )?$item->checkbox_input_titles[$key][0]:$item->checkbox_input_titles[$key][1]]));
                return false;
            }
            if(isset($this->selectedCheckbox[$key]) && (count($this->selectedCheckbox[$key]) > (int)$item->checkbox_input_maximum_choices[$key])){
                $validator->errors()->add('selectedCheckbox', __('Maximum :option options is ',['option'=>($locale == 'en' )?$item->checkbox_input_titles[$key][0]:$item->checkbox_input_titles[$key][1]]).$item->checkbox_input_maximum_choices[$key]);
                return false;
            }
        }
        return true;
    }

    public function validateRadioOptions($validator,$item){
        $locale =  app()->getLocale();
        foreach($item->selection_required as $key=>$option){
            if($option == 'true' && !isset($this->selectedRadio[$key])) {
                $validator->errors()->add('selectedRadio', __(':option is required',['option'=>($locale == 'en' )?$item->selection_input_titles[$key][0]:$item->selection_input_titles[$key][1]]));
                return false;
            }
        }
        return true;
    }
     public function validateDropdownOptions($validator,$item){
        $locale =  app()->getLocale();
        foreach($item->dropdown_required as $key=>$option){
            if($option == 'true' && !isset($this->selectedDropdown[$key]) ?? false) {
                $validator->errors()->add('selectedDropdown',__(':option is required',['option'=>($locale == 'en' )?$item->dropdown_input_titles[$key][0]:$item->dropdown_input_titles[$key][1]]));
                return false;
            }
        }
        return true;
    }

}
