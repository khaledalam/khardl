<?php

namespace Database\Seeders;

use App\Models\TraderRequirement;
use App\Models\User;
use Faker\Factory;
use Faker\Generator;
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
            'position'=>"Super Admin",
            'password' => bcrypt(env("NOVA_ADMIN_PASSWORD",'password')),
            'remember_token' => Str::random(10),
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        
        $user->assignRole('Administrator');

        $faker = (new Factory())::create();
        TraderRequirement::create([
            'user_id' => $user->id,
            'IBAN' => $faker->iban,
            'facility_name' => $faker->text,
            'commercial_registration' => $faker->filePath(),
            'tax_registration_certificate' => $faker->filePath(),
            'bank_certificate' => $faker->filePath(),
            'identity_of_owner_or_manager' => $faker->filePath(),
            'national_address' => $faker->address
        ]);

    }
}
