<?php

namespace Database\Factories\tenant;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class BranchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'lat' => fake()->randomFloat(2,1,20),
            'lng' => fake()->randomFloat(2,1,20),
            'phone' => fake()->numerify('966#########'),
            'address' => fake()->address,
            'is_primary' => fake()->boolean,
            'monday_open' => fake()->dateTime(),
            'monday_close' => fake()->dateTime(),
            'monday_closed' => fake()->boolean,
            'tuesday_open' => fake()->dateTime(),
            'tuesday_close' => fake()->dateTime(),
            'tuesday_closed' => fake()->boolean,
            'wednesday_open' => fake()->dateTime(),
            'wednesday_close' => fake()->dateTime(),
            'wednesday_closed' => fake()->boolean,
            'thursday_open' => fake()->dateTime(),
            'thursday_close' => fake()->dateTime(),
            'thursday_closed' => fake()->boolean,
            'friday_open' => fake()->dateTime(),
            'friday_close' => fake()->dateTime(),
            'friday_closed' => fake()->boolean,
            'saturday_open' => fake()->dateTime(),
            'saturday_close' => fake()->dateTime(),
            'saturday_closed' => fake()->boolean,
            'sunday_open' => fake()->dateTime(),
            'sunday_close' => fake()->dateTime(),
            'sunday_closed' => fake()->boolean,
            'delivery_availability' => fake()->boolean,
            'pickup_availability' => fake()->boolean,
            'preparation_time_delivery' => fake()->dateTime(),
        ];
    }
}
