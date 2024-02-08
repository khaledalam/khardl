<?php

namespace Database\Factories\tenant;

use App\Enums\Admin\CouponTypes;
use App\Models\Tenant\Branch;
use App\Models\Tenant\PaymentMethod;
use App\Models\Tenant\RestaurantUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => fake()->randomElement(CouponTypes::values()),
            'type' => fake()->name,
            'amount' => fake()->numberBetween(1,30),
            'max_discount_amount' => fake()->numberBetween(50,200),
            'max_use_per_user' => fake()->numberBetween(1,5),
            'max_use' => fake()->numberBetween(10,50),
            'minimum_cart_amount' => fake()->numberBetween(50,500),
            'active_from' => now(),
            'expire_at' => now(),
            'status' => fake()->boolean
        ];
    }
}
