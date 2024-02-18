<?php

namespace Database\Factories\tenant;


use App\Models\Tenant\Branch;
use App\Models\Tenant\Category;
use App\Models\Tenant\RestaurantUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tenant\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $hasCheckbox = fake()->numberBetween(0, 2);//  1 : 2 probability
        $hasSelection = fake()->numberBetween(0, 2);//  1 : 2 probability
        $hasDropdown = fake()->numberBetween(0, 2);//  1 : 2 probability
        return [
            'category_id' => Category::factory(),
            'branch_id' => Branch::factory(),
            'user_id' => RestaurantUser::factory(),
            'price' => fake()->numberBetween(10, 100),
            'calories' => fake()->numberBetween(100, 1000),
            'name' => fake()->name,
            'description' => fake()->text,
            'checkbox_required' => $hasCheckbox ? $this->dataOptionRequired($hasCheckbox) : null,
            'checkbox_input_titles' => $hasCheckbox ? $this->dataOptionTitles($hasCheckbox) : null,
            'checkbox_input_maximum_choices' => $hasCheckbox ? $this->dataOptionMaximumChoices($hasCheckbox) : null,
            'checkbox_input_names' => $hasCheckbox ? $checkBoxNames = $this->dataOptionNames($hasCheckbox) : null,
            'checkbox_input_prices' => $hasCheckbox ? $this->dataOptionPrices($hasCheckbox, $checkBoxNames) : null,
            'selection_required' => $hasSelection ? $this->dataOptionRequired($hasSelection) : null,
            'selection_input_titles' => $hasSelection ? $this->dataOptionTitles($hasSelection) : null,
            'selection_input_names' => $hasSelection ? $selectionNames = $this->dataOptionNames($hasSelection) : null,
            'selection_input_prices' => $hasSelection ? $this->dataOptionPrices($hasSelection, $selectionNames) : null,
            'dropdown_required' => $hasDropdown ? $this->dataOptionRequired($hasDropdown) : null,
            'dropdown_input_titles' => $hasDropdown ? $this->dataOptionTitles($hasDropdown) : null,
            'dropdown_input_names' => $hasDropdown ? $this->dataOptionNames($hasDropdown) : null,
            'availability' => fake()->boolean,
            'photo' => 'http://first.khardl:8000/tenancy/assets/seeders/items/' . fake()->numberBetween(1, 10) . '.jpg'
        ];
    }
    public function dataOptionRequired($num,$is_required = null)
    {
        $option = [];
        for ($i = 0; $i < $num; $i++) {
            if($is_required){
                if($is_required){
                    $option[] = "true";
                }else{
                    $option[] = "false";
                }
            }else{
                if(fake()->boolean){
                    $option[] = "true";
                }else{
                    $option[] = "false";
                }
            }
        }
        return $option;
    }
    public function dataOptionTitles($num)
    {
        $option = [];
        for ($i = 0; $i < $num; $i++) {
            $option[] = [
                fake()->name,
                fake()->name,
            ];
        }
        return $option;
    }
    public function dataOptionMaximumChoices($num)
    {
        $option = [];
        for ($i = 0; $i < $num; $i++) {
            $option[] = (string) fake()->numberBetween(1, 3);
        }
        return $option;
    }
    public function dataOptionPrices($num, $names)
    {
        $option = [];
        for ($i = 0; $i < $num; $i++) {
            $option[$i] = [];
            foreach ($names[$i] as $nestedKey => $nestedOption) {
                $option[$i][$nestedKey] = fake()->numberBetween(1,30);
            }
        }
        return $option;
    }
    public function dataOptionNames($num)
    {
        $option = [];
        for ($i = 0; $i < $num; $i++) {
            $option[$i] = [];
            $nestedOptions = fake()->numberBetween(1, 4);
            for ($ii = 0; $ii < $nestedOptions; $ii++) {
                $option[$i][$ii] = [
                    fake()->name,
                    fake()->name,
                ];
            }

        }
        return $option;
    }
}
