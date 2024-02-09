<?php

namespace Database\Factories\tenant;

use App\Models\Tenant\Branch;
use App\Models\Tenant\Coupon;
use App\Models\Tenant\DeliveryType;
use App\Models\Tenant\Order;
use App\Models\Tenant\PaymentMethod;
use App\Models\Tenant\RestaurantUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'transaction_id' => fake()->uuid,
            'user_id' => RestaurantUser::factory(),
            'branch_id' => Branch::factory(),
            'payment_method_id' => PaymentMethod::factory(),
            'delivery_type_id' => DeliveryType::factory(),
            'total' => fake()->numberBetween(100,1000),
            'subtotal' => fake()->numberBetween(100,1000),
            'delivery_cost' =>  fake()->boolean ?? fake()->numberBetween(0,50),
            'vat' => fake()->numberBetween(1,15),
            'status' => fake()->randomElement(Order::STATUS),
            'payment_status' => fake()->randomElement(['pending','paid']),
            'shipping_address' => fake()->address,
            'order_notes' => fake()->address,
            'deliver_by' => $isDeliver_by = fake()->numberBetween(0,4)? $company = fake()->randomElement(['yeswa','streetline','cervo']):null,
            'cervo_ref' => $isDeliver_by&&$company=='cervo'? fake()->uuid :null,
            'yeswa_ref' => $isDeliver_by&&$company=='yeswa'? fake()->uuid :null,
            'streetline_ref' => $isDeliver_by&&$company=='streetline'? fake()->uuid :null,
            'coupon_id' => $coupon = fake()->numberBetween(0,5) ? null: Coupon::factory(),
            'discount' => $coupon ? null : fake()->numberBetween(50,200),
            'driver_id' => $isDeliver_by ? null :RestaurantUser::factory(),
            'received_by_restaurant_at' => now(),

        ];
    }
}
