<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant\Branch;
use Database\Seeders\Tenant\BranchSeeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Tenant\RestaurantUser;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branch = Branch::find(BranchSeeder::BRANCH_ID);
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $user = RestaurantUser::create([
            'first_name' => "Driver",
            'last_name' => "Driver",
            'email' => "Driver@first.com",
            'phone_verified_at' => now(),
            'phone' => '966121200',
            'status' => 'active',
            'address' => 'test address',
            "lat" => 24.7136,
            "lng" => 46.6753,
            'password' => bcrypt(env("NOVA_ADMIN_PASSWORD", 'password')),
            'remember_token' => Str::random(10),
        ]);
        $user->branch()->associate($branch);
        $user->save();

        $user->assignRole('Driver');
        DB::table('permissions_driver')->insert([
            'user_id' => $user->id,
            'can_see_orders' => true,
            'can_see_branches' => true,
            'can_modify_and_see_other_drivers' => true
        ]);
    }
}
