<?php

namespace Database\Factories\tenant;

use App\Models\Tenant\Branch;
use App\Models\Tenant\RestaurantUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tenant\Category>
 */
class CategoryFactory extends Factory
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
            'branch_id' => Branch::factory(),
            'user_id' => RestaurantUser::factory(),
        ];
    }
}
