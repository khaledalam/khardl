<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        if(env('APP_ENV') =='testing'){
            return [
                'first_name' => fake()->name,
                'last_name' => fake()->name,
                'email' => fake()->email,
                'phone'=> fake()->numerify('966#########'),
                'email_verified_at' => now(),
                'status'=> fake()->randomElement(['active','blocked','inactive']),
                'address' => fake()->address,
                'position'=> fake()->name,
                'password' => fake()->password,
                'remember_token' => Str::random(10),
            ];
        }
        return [
            'first_name' => "khardl",
            'last_name' => "admin",
            'email' => "khardl@admin.com",
            'phone'=>'966999999999',
            'email_verified_at' => now(),
            'status'=> 'active',
            'address' => 'test address',
            'position'=>"Super Admin",
            'password' => bcrypt('khardl@123'),
            'remember_token' => Str::random(10),
        ];
    }


    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
