<?php

namespace Database\Seeders\Tenant;

use Faker\Factory;
use Faker\Generator;
use App\Models\Tenant\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\TraderRequirement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => "khardl",
            'last_name' => "customer",
            'email' => env("NOVA_ADMIN_EMAIL","khardl@customer.com"),
            'email_verified_at' => now(),
            'status'=> 'active',
            'password' => bcrypt(env("NOVA_ADMIN_PASSWORD",'password')),
            'remember_token' => Str::random(10),
        ]);
        

    }
}
