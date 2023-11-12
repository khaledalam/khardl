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


        // old code permissions 
        \DB::table('permissions')->insert([
            'user_id'=> 1,
            'can_access_dashboard'=> true,
            'can_access_restaurants'=> true,
            'can_view_restaurants'=> true,
            'can_delete_restaurants'=> true,
            'can_approve_restaurants'=> true,
            'can_see_admins'=> true,
            'can_add_admins'=> true,
            'can_edit_admins'=> true,
            'can_promoters'=> true,
            'can_see_logs'=> true,
            'can_settings'=> true,
            'can_edit_profile'=> true,
        ]);

    }
}
