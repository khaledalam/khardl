<?php

namespace Database\Seeders;

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
            'first_name' => "khardl",
            'last_name' => "admin",
            'email' => env("NOVA_ADMIN_EMAIL","khardl@admin.com"),
            'email_verified_at' => now(),
            'status'=> 'active',
            'position'=>"#",
            'password' => bcrypt(env("NOVA_ADMIN_PASSWORD",'password')),
            'remember_token' => Str::random(10),
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        $user->assignRole('Administrator');
        $user->assignRole('Restaurant Owner');

    }
}
