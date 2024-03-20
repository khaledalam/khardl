<?php

namespace Database\Seeders;

use App\Models\TraderRequirement;
use App\Models\User;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public const SUPER_ADMIN_USER_ID = 1;
    public const RESTAURANT_OWNER_USER_ID = 2;
    public const RESTAURANT_OWNER_SECOND_USER_ID = 3;
    public const RESTAURANT_OWNER_THIRD_USER_ID = 4;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'id' => self::SUPER_ADMIN_USER_ID,
            'first_name' => "khardl",
            'last_name' => "admin",
            'email' => "info@khardl.com",
            'phone'=>'966999999999',
            'email_verified_at' => now(),
            'status'=> 'active',
            'address' => 'test address',
            'position'=>"Super Admin",
            'password' => bcrypt('khardl@123'),
            'remember_token' => Str::random(10),
        ]);

        $user->assignRole(Role::findByName('Administrator'));

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

        $this->createRO(self::RESTAURANT_OWNER_USER_ID, 'khardl', 'first');
        $this->createRO(self::RESTAURANT_OWNER_SECOND_USER_ID, 'second', 'second');
        $this->createRO(self::RESTAURANT_OWNER_THIRD_USER_ID, 'third', 'third');

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

    private function createRO(string $id, string $name, string $restaurant_name): void
    {
        $user = User::create([
            'id' => $id,
            'first_name' => $name,
            'last_name' => "Restaurant",
            'email' => $name . "@restaurant.com",
            'email_verified_at' => now(),
            'status'=> 'active',
            'address' => 'test address',
            'phone'=>'966222222222',
            'position'=>"Restaurant Owner",
            'restaurant_name' => $restaurant_name,
            'password' => bcrypt('khardl@123'),
            'remember_token' => Str::random(10),
        ]);
        $faker = (new Factory())::create();
        TraderRequirement::create([
            'user_id' => $id,
            'IBAN' => $faker->iban,
            'facility_name' => $faker->text,
            'commercial_registration' => $faker->filePath(),
            'tax_registration_certificate' => $faker->filePath(),
            'bank_certificate' => $faker->filePath(),
            'identity_of_owner_or_manager' => $faker->filePath(),
            'national_address' => $faker->address
        ]);

        $user->assignRole(Role::findByName('Restaurant Owner'));
    }
}
