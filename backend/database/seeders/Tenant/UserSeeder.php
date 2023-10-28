<?php

namespace Database\Seeders\Tenant;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'first_name' => fake()->name(),
            'last_name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'status'=> 'active',
            'password' => bcrypt("password"),
            'remember_token' => Str::random(10),
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        $user->assignRole('Administrator');
    }
}
