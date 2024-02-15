<?php

namespace Tests\Unit\Web\Tenant\Customer\Cart;
use App\Http\Middleware\RestaurantLive;
use App\Http\Middleware\RestaurantSubLive;
use App\Models\Tenant\Item;
use Tests\TenantTestCase;

use App\Models\ROSubscription;
use App\Models\Tenant\Setting;
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
        $this->actingAs($this->user,'web');
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
    private function itemOption(Item $item,$required,$input_names)
    {
        $option = [];
        if(!$item->$required)return null;
        foreach ($item->$required as $key => $value) {
            if($value=="true"){
                $fakeIndexOption = fake()->numberBetween(0,count($item->$input_names[$key]) - 1);//Select one option
                $option[$key] = $fakeIndexOption;
            }
        }
        return $option;
    }
    private function itemOptionCheckbox(Item $item)
    {
        $option = [];
        if(!$item->checkbox_required)return null;
        foreach ($item->checkbox_required as $key => $value) {
            if($value=="true"){
                $optionNested = [];
                $fakeIndexOption = fake()->numberBetween(0,count($item->checkbox_input_names[$key]) - 1);//Select one option
                $optionNested[] = $fakeIndexOption;
                $option[$key] = $optionNested;
            }
        }
        return $option;
    }
    public function test_add_item_to_cart_success()
    {
        for ($i=0; $i < 3; $i++) {
            $item = $this->createItem();
            $selectedCheckbox = $this->itemOptionCheckbox($item);
            $selectedRadio = $this->itemOption($item,'selection_required','selection_input_names');
            $selectedDropdown = $this->itemOption($item,'dropdown_required','dropdown_input_names');
            $data = [
                'item_id' => $item->id,
                'quantity' => fake()->numberBetween(1,5),
                'branch_id' => $this->user->branch->id,
                'notes' => fake()->text,
                'selectedCheckbox' => $selectedCheckbox,
                'selectedRadio' => $selectedRadio,
                'selectedDropdown' => $selectedDropdown,
            ];
            $response = $this->postJson(self::path,$data);
            $this->assertDatabaseHas('carts',[
                'user_id' => $this->user->id,
            ]);
            $this->assertDatabaseHas('cart_items',[
                'notes' => $data['notes'],
                'item_id' => $data['item_id'],
                'quantity' => $data['quantity'],
            ]);
            $response->assertOk();
        }
    }
}
