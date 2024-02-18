<?php

namespace Tests\Unit\Web\Tenant\Customer\Cart;
use App\Models\Tenant\CartItem;


class ChangeQuantityToItemTest extends CartData
{
    public function test_change_qty_success()
    {
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
        $response->assertOk();
        $cartItem = CartItem::first();
        $data = [
            'quantity' => fake()->numberBetween(1,10),
            'notes' => fake()->text,
        ];
        $response = $this->putJson(self::path.'/'.$cartItem->id,$data);
        $response->assertOk();
        $this->assertDatabaseHas('cart_items', [
            'notes' => $data['notes'],
            'quantity' => $data['quantity'],
            'price' => $item->price,
            'total' => ($item->price + $cartItem->options_price) * $data['quantity']
        ]);
    }
}
