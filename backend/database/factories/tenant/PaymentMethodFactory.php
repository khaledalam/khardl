<?php

namespace Database\Factories\tenant;

use App\Models\Tenant\Branch;
use App\Models\Tenant\PaymentMethod;
use App\Models\Tenant\RestaurantUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class PaymentMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Cash on Delivery','Online']),
            // 'is_active' => 1
        ];
    }
}
