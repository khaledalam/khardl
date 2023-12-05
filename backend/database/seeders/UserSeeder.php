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
    public const SUPER_ADMIN_USER_ID = 1;
    public const RESTAURANT_OWNER_USER_ID = 2;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'id' => self::SUPER_ADMIN_USER_ID,
            'first_name' => "khardl",
            'last_name' => "admin",
            'email' => "khardl@admin.com",
            'email_verified_at' => now(),
            'status'=> 'active',
            'phone'=>'966123456789',
            'position'=>"Super Admin",
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ]);

        $user->assignRole('Administrator');

        $faker = (new Factory())::create();
        TraderRequirement::create([
            'user_id' => self::SUPER_ADMIN_USER_ID,
            'IBAN' => $faker->iban,
            'facility_name' => $faker->text,
            'commercial_registration' => $faker->filePath(),
            'tax_registration_certificate' => $faker->filePath(),
            'bank_certificate' => $faker->filePath(),
            'identity_of_owner_or_manager' => $faker->filePath(),
            'national_address' => $faker->address
        ]);
        $user = User::create([
            'id' => self::RESTAURANT_OWNER_USER_ID,
            'first_name' => "khadrl",
            'last_name' => "restaurant",
            'email' => "khadrl@restaurant.com",
            'email_verified_at' => now(),
            'status'=> 'active',
            'phone'=>'966123456789',
            'position'=>"Restaurant Owner",
            'restaurant_name' => 'first',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ]);
        $faker = (new Factory())::create();
        TraderRequirement::create([
            'user_id' => self::RESTAURANT_OWNER_USER_ID,
            'IBAN' => $faker->iban,
            'facility_name' => $faker->text,
            'commercial_registration' => $faker->filePath(),
            'tax_registration_certificate' => $faker->filePath(),
            'bank_certificate' => $faker->filePath(),
            'identity_of_owner_or_manager' => $faker->filePath(),
            'national_address' => $faker->address
        ]);

        $user->assignRole('Restaurant Owner');

        // old code permissions
        \DB::table('permissions')->insert([
            'user_id'=> self::SUPER_ADMIN_USER_ID,
            'can_access_dashboard'=> true, //  TODO @todo not yet
            'can_access_restaurants'=> true, 
            'can_view_restaurants'=> true,
            'can_delete_restaurants'=> true, // TODO @todo not yet
            'can_approve_restaurants'=> true,
            'can_see_admins'=> true,
            'can_add_admins'=> true,
            'can_edit_admins'=> true,
            'can_promoters'=> true,
            'can_see_logs'=> true,
            'can_settings'=> true,
            'can_edit_profile'=> true,
            'can_see_restaurant_owners'=>true,
        
            
        ]);

    }
}
