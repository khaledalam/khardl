<?php

namespace Database\Factories\Tenant;


use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UserFactory extends Factory
{
    protected $model = \App\Models\Tenant\User::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone'=> null,
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ];
    }
}
