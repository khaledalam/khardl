<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant\Branch;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Tenant\RestaurantUser;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branch =Branch::find(1);
        $user = RestaurantUser::create([
            'first_name' => "Worker",
            'last_name' => "Worker",
            'email' => "worker@first.com",
            'phone_verified_at' => now(),
            'status'=> 'active',
            'password' => bcrypt(env("NOVA_ADMIN_PASSWORD",'password')),
            'remember_token' => Str::random(10),
        ]);
        $user->branch()->associate($branch);
        $user->save();

        $user->assignRole('Worker');
        DB::table('permissions_worker')->insert([
            'user_id'=>$user->id,
            'can_modify_and_see_other_workers'=>true,
            'can_modify_working_time'=>true,
            'can_modify_advertisements'=>true,
            'can_edit_menu'=>true,
            'can_control_payment'=>true,
        ]);

        $user = RestaurantUser::create([
            'first_name' => "customer",
            'last_name' => "customer",
            'email' => "customer@first.com",
            'phone' => '966123456789',
            'phone_verified_at' => now(),
            'status'=> 'active',
            'password' => bcrypt(env("NOVA_ADMIN_PASSWORD",'password')),
            'remember_token' => Str::random(10),
        ]);

        $user->branch()->associate($branch);
        $user->save();

    }
}
