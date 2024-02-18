<?php

namespace Tests\Unit\Web\Tenant\Customer\Cart;

use App\Http\Middleware\RestaurantLive;
use App\Http\Middleware\RestaurantSubLive;
use App\Models\Tenant\Item;
use Tests\TenantTestCase;
use App\Models\Tenant\RestaurantUser;



class CartData extends TenantTestCase
{
    protected $tenancy = true;
    protected $user;
    public const path = "/carts";
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
    public function itemOption(Item $item, $required, $input_names)
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
    public function itemOptionCheckbox(Item $item)
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

}
