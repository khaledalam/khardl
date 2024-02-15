<?php

namespace Database\Factories\tenant;


use App\Models\Tenant\Branch;
use App\Models\Tenant\Category;
use App\Models\Tenant\RestaurantUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tenant\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'branch_id' => Branch::factory(),
            'user_id' => RestaurantUser::factory(),
            'price' => fake()->numberBetween(10,100),
            'calories' => fake()->numberBetween(100,1000),
            'name' => fake()->name,
            'description' => fake()->text,
            
        ];
    }
}
