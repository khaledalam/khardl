<?php

namespace Tests\Unit\Web\Tenant\Customer\Cart;

use App\Http\Middleware\RestaurantLive;
use App\Http\Middleware\RestaurantSubLive;
use App\Models\Tenant\Cart;
use App\Models\Tenant\Item;
use Database\Factories\tenant\ItemFactory;
use Tests\TenantTestCase;
use App\Models\Tenant\RestaurantUser;



class AddItemToCartTest extends TenantTestCase
{
    protected $tenancy = true;
    protected $user;
    private const path = "/carts";
    public function setUp(): void
    {
        parent::setUp();
        $this->user = $this->createUser([
            'phone_verified_at' => now()
        ]);
        $this->actingAs($this->user, 'web');
        $this->withoutMiddleware(RestaurantLive::class);
        $this->withoutMiddleware(RestaurantSubLive::class);
    }
    public function createUser($options = null): RestaurantUser
    {
        return RestaurantUser::factory()->create($options);
    }
    public function createItem($options = null): Item
    {
        return Item::factory()->create($options);
    }
    private function itemOption(Item $item, $required, $input_names)
    {
        $option = [];
        if (!$item->$required)
            return null;
        foreach ($item->$required as $key => $value) {
            if ($value == "true") {
                $fakeIndexOption = fake()->numberBetween(0, count($item->$input_names[$key]) - 1);//Select one option
                $option[$key] = $fakeIndexOption;
            }
        }
        return $option;
    }
    private function itemOptionCheckbox(Item $item)
    {
        $option = [];
        if (!$item->checkbox_required)
            return null;
        foreach ($item->checkbox_required as $key => $value) {
            if ($value == "true") {
                $optionNested = [];
                $fakeIndexOption = fake()->numberBetween(0, count($item->checkbox_input_names[$key]) - 1);//Select one option
                $optionNested[] = $fakeIndexOption;
                $option[$key] = $optionNested;
            }
        }
        return $option;
    }
    public function checkBoxOptions($options, $item)
    {
        $result = null;
        $totalPrice = 0;
        if ($options) {
            foreach ($options as $i => $option) {
                foreach ($option as $j => $sub_option) {
                    $result[$i]['ar'][$item->checkbox_input_titles[$i][1]][] = [$item->checkbox_input_names[$i][$sub_option][1], $item->checkbox_input_prices[$i][$sub_option]];
                    $result[$i]['en'][$item->checkbox_input_titles[$i][0]][] = [$item->checkbox_input_names[$i][$sub_option][0], $item->checkbox_input_prices[$i][$sub_option]];

                    $totalPrice += (float) $item->checkbox_input_prices[$i][$sub_option];
                }
            }
        }
        return [$result, $totalPrice];
    }
    public function selectionOptions($options, $item)
    {
        $result = null;
        $totalPrice = 0;
        if ($options) {
            foreach ($options as $i => $option) {
                $result[$i]['en'][$item->selection_input_titles[$i][0]] = [$item->selection_input_names[$i][$option][0], $item->selection_input_prices[$i][$option]];
                $result[$i]['ar'][$item->selection_input_titles[$i][1]] = [$item->selection_input_names[$i][$option][1], $item->selection_input_prices[$i][$option]];
                $totalPrice += (float) $item->selection_input_prices[$i][$option];
            }
        }
        return [$result, $totalPrice];
    }
    public function dropDownOptions($options, $item)
    {
        $result = null;
        if ($options) {
            foreach ($options as $i => $option) {
                if ($option !== null) {
                    $result[$i]['en'][$item->dropdown_input_titles[$i][0]] = $item->dropdown_input_names[$i][$option][0];
                    $result[$i]['ar'][$item->dropdown_input_titles[$i][1]] = $item->dropdown_input_names[$i][$option][1];
                }
            }
        }
        return $result;
    }
    public function test_add_item_to_cart_success()
    {
        for ($i = 0; $i < 3; $i++) {
            $item = $this->createItem();
            $selectedCheckbox = $this->itemOptionCheckbox($item);
            $selectedRadio = $this->itemOption($item, 'selection_required', 'selection_input_names');
            $selectedDropdown = $this->itemOption($item, 'dropdown_required', 'dropdown_input_names');
            $data = [
                'item_id' => $item->id,
                'quantity' => fake()->numberBetween(1, 5),
                'branch_id' => $this->user->branch->id,
                'notes' => fake()->text,
                'selectedCheckbox' => $selectedCheckbox,
                'selectedRadio' => $selectedRadio,
                'selectedDropdown' => $selectedDropdown,
            ];
            $response = $this->postJson(self::path, $data);
            $this->assertDatabaseHas('carts', [
                'user_id' => $this->user->id,
            ]);
            $totalOptionPrice = 0;
            [$checkBoxOptions, $optionPrice] = $this->checkBoxOptions($selectedCheckbox, $item);
            $totalOptionPrice += $optionPrice;
            [$selectionOptions, $optionPrice] = $this->selectionOptions($selectedRadio, $item);
            $totalOptionPrice += $optionPrice;
            $dropDownOptions = $this->dropDownOptions($selectedDropdown, $item);
            $this->assertDatabaseHas('cart_items', [
                'notes' => $data['notes'],
                'item_id' => $data['item_id'],
                'quantity' => $data['quantity'],
                'price' => $item->price,
                'total' => ($item->price + $totalOptionPrice) * $data['quantity']
            ]);
            if ($checkBoxOptions) {
                $this->assertEquals($checkBoxOptions, Cart::first()->items->first()->checkbox_options);
            }
            if ($selectionOptions) {
                $this->assertEquals($selectionOptions, Cart::first()->items->first()->selection_options);
            }
            if ($dropDownOptions) {
                $this->assertEquals($dropDownOptions, Cart::first()->items->first()->dropdown_options);
            }
            $response->assertOk();
        }
    }
    public function test_fail_no_item()
    {
        $response = $this->postJson(self::path);
        $response->assertStatus(404);
    }
    public function test_required_quantity_fields()
    {
        $item = $this->createItem([
            'selection_required' => null,
            'dropdown_required' => null,
            'checkbox_required' => null,
        ]);
        $data = [
            'item_id' => $item->id,
        ];
        $response = $this->postJson(self::path, $data);
        $response->assertUnprocessable();
        $response->assertJsonValidationErrors([
            'quantity',
        ]);
    }
    public function test_required_branch_fields()
    {
        $item = $this->createItem([
            'selection_required' => null,
            'dropdown_required' => null,
            'checkbox_required' => null,
        ]);
        $data = [
            'item_id' => $item->id,
            'quantity' => 1
        ];
        $response = $this->postJson(self::path, $data);
        $response->assertUnprocessable();
        $response->assertJsonValidationErrors([
            'branch_id',
        ]);
    }
    public function test_required_checkbox()
    {
        $itemFactory = new ItemFactory();
        $hasCheckbox = 1;//Has 1 Checkbox option
        $item = $this->createItem([
            'selection_required' => null,
            'dropdown_required' => null,
            'checkbox_required' => $hasCheckbox ? $itemFactory->dataOptionRequired($hasCheckbox, true) : null,
            'checkbox_input_titles' => $hasCheckbox ? $itemFactory->dataOptionTitles($hasCheckbox) : null,
            'checkbox_input_maximum_choices' => $hasCheckbox ? $itemFactory->dataOptionMaximumChoices($hasCheckbox) : null,
            'checkbox_input_names' => $hasCheckbox ? $checkBoxNames = $itemFactory->dataOptionNames($hasCheckbox) : null,
            'checkbox_input_prices' => $hasCheckbox ? $itemFactory->dataOptionPrices($hasCheckbox, $checkBoxNames) : null,
        ]);
        $data = [
            'item_id' => $item->id,
            'quantity' => fake()->numberBetween(1, 5),
            'branch_id' => $this->user->branch->id,
            'notes' => fake()->text,
        ];
        $response = $this->postJson(self::path, $data);
        $response->assertUnprocessable();
        $response->assertJsonValidationErrors([
            'selectedCheckbox',
        ]);
    }
    public function test_required_radio()
    {
        $itemFactory = new ItemFactory();
        $hasSelection = 1;//Has 1 Selection option
        $item = $this->createItem([
            'checkbox_required' => null,
            'dropdown_required' => null,
            'selection_required' => $hasSelection ? $itemFactory->dataOptionRequired($hasSelection, true) : null,
            'selection_input_titles' => $hasSelection ? $itemFactory->dataOptionTitles($hasSelection) : null,
            'selection_input_names' => $hasSelection ? $selectionNames = $itemFactory->dataOptionNames($hasSelection) : null,
            'selection_input_prices' => $hasSelection ? $itemFactory->dataOptionPrices($hasSelection, $selectionNames) : null,
        ]);
        $data = [
            'item_id' => $item->id,
            'quantity' => fake()->numberBetween(1, 5),
            'branch_id' => $this->user->branch->id,
            'notes' => fake()->text,
        ];
        $response = $this->postJson(self::path, $data);
        $response->assertUnprocessable();
        $response->assertJsonValidationErrors([
            'selectedRadio',
        ]);
    }
    public function test_required_dropdown()
    {
        $itemFactory = new ItemFactory();
        $hasDropdown = 1;//Has 1 Dropdown option
        $item = $this->createItem([
            'checkbox_required' => null,
            'selection_required' => null,
            'dropdown_required' => $hasDropdown ? $itemFactory->dataOptionRequired($hasDropdown, true) : null,
            'dropdown_input_titles' => $hasDropdown ? $itemFactory->dataOptionTitles($hasDropdown) : null,
            'dropdown_input_names' => $hasDropdown ? $itemFactory->dataOptionNames($hasDropdown) : null,
        ]);
        $data = [
            'item_id' => $item->id,
            'quantity' => fake()->numberBetween(1, 5),
            'branch_id' => $this->user->branch->id,
            'notes' => fake()->text,
        ];
        $response = $this->postJson(self::path, $data);
        $response->assertUnprocessable();
        $response->assertJsonValidationErrors([
            'selectedDropdown',
        ]);
    }
}
