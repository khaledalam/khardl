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
        return [
            'first_name' => "khardl",
            'last_name' => "admin",
            'email' => "khardl@admin.com",
            'phone'=>'966999999999',
            'email_verified_at' => now(),
            'status'=> 'active',
            'address' => 'test address',
            'position'=>"Super Admin",
            'password' => bcrypt('password'),
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
