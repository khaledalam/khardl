<?php

namespace Database\Seeders\Tenant;


use App\Models\Tenant\RestaurantUser;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = RestaurantUser::create([
            'first_name' => "Worker",
            'last_name' => "Worker",
            'email' => "worker@first.com",
            'email_verified_at' => now(),
            'status'=> 'active',
            'password' => bcrypt(env("NOVA_ADMIN_PASSWORD",'password')),
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole('Worker');

        

    }
}
