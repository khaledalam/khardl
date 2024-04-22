<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant\Branch;
use Carbon\Carbon;
use Database\Seeders\HelperSeeder;
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
            'phone' => '966333333333',
            'status' => 'active',
            'address' => 'test address',
            "lat" => 24.7136,
            "lng" => 46.6753,
            'password' => bcrypt(HelperSeeder::PASSWORD),
            'remember_token' => Str::random(10),
        ]);
        $user->branch()->associate($branch);
        $user->save();

        $user->assignRole('Driver');
    }
}
