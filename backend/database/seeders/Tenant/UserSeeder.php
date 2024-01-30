<?php

namespace Database\Seeders\Tenant;

use Illuminate\Support\Str;
use App\Models\Tenant\Branch;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Tenant\RestaurantUser;
use App\Packages\TapPayment\Customer\Customer;

class UserSeeder extends Seeder
{
    public $dependson = ['CategoryItemSeeder'];

    public const RESTAURANT_CUSTOMER_USER_ID = 3;
    public const RESTAURANT_WORKER_USER_ID = 4;
    public const RESTAURANT_WORKER_B_USER_ID = 5;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branch = Branch::find(BranchSeeder::BRANCH_ID);

      
        if(env('APP_ENV') == 'local'){
            $customer_tap_id = Customer::DEFAULT_CUSTOMER_ID;
        }else {
            $customer_tap_id = Customer::DEFAULT_LIVE_CUSTOMER_ID;
        }
        $user = RestaurantUser::create([
            'id' => self::RESTAURANT_WORKER_USER_ID,
            'first_name' => "Worker",
            'last_name' => "Worker",
            'email' => "worker@first.com",
            'phone_verified_at' => now(),
            'phone'=>'966000000000',
            'status'=> 'active',
            'address' => 'test address',
            "lat"=>24.7136,
            "lng"=> 46.6753,
            'tap_customer_id'=> $customer_tap_id,
            'password' => bcrypt(env("NOVA_ADMIN_PASSWORD",'password')),
            'remember_token' => Str::random(10),
        ]);
        $user->branch()->associate($branch);
        $user->save();

        $user->assignRole('Worker');
        DB::table('permissions_worker')->insert([
            'user_id'=>self::RESTAURANT_WORKER_USER_ID,
            'can_modify_and_see_other_workers'=>true,
            'can_modify_working_time'=>true,
            'can_modify_advertisements'=>true,
            'can_edit_menu'=>true,
            'can_control_payment'=>true,
        ]);

        $user = RestaurantUser::create([
            'id' => self::RESTAURANT_WORKER_B_USER_ID,
            'first_name' => "Worker B first",
            'last_name' => "Worker B last",
            'email' => "worker2@first.com",
            'phone'=>'966000000001',
            'phone_verified_at' => now(),
            'status'=> 'active',
            'address' => 'test address',
            "lat"=>24.7136,
            "lng"=> 46.6753,
            'tap_customer_id'=> $customer_tap_id,
            'password' => bcrypt(env("NOVA_ADMIN_PASSWORD",'password')),
            'remember_token' => Str::random(10),
        ]);
        $user->branch()->associate($branch);
        $user->save();

        $user->assignRole('Worker');
        DB::table('permissions_worker')->insert([
            'user_id'=>self::RESTAURANT_WORKER_B_USER_ID,
            'can_modify_and_see_other_workers'=>true,
            'can_modify_working_time'=>true,
            'can_modify_advertisements'=>true,
            'can_edit_menu'=>true,
            'can_control_payment'=>true,
        ]);

        $user = RestaurantUser::create([
            'id' => self::RESTAURANT_CUSTOMER_USER_ID,
            'first_name' => "customer",
            'last_name' => "customer",
            'email' => "customer@first.com",
            'phone'=>'966111111111',
            'phone_verified_at' => now(),
            'status'=> 'active',
            'address' => 'test address',
            "lat"=>24.7136,
            "lng"=> 46.6753,
            'tap_customer_id'=> $customer_tap_id,
            'password' => bcrypt(env("NOVA_ADMIN_PASSWORD",'password')),
            'remember_token' => Str::random(10),
        ]);

        $user->branch()->associate($branch);
        $user->save();


    }
}
