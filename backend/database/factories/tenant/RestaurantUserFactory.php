<?php

namespace Database\Factories\tenant;

use App\Models\Tenant\Branch;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class RestaurantUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'email' => fake()->email,
            'phone' => fake()->numerify('966#########'),
            'status' => fake()->randomElement(['active', 'inactive', 'suspended']),
            'address' => fake()->address,
            'password' => bcrypt('khardl@123'),
            'branch_id' => Branch::factory(),
            'remember_token' => Str::random(10),
        ];
    }
}
