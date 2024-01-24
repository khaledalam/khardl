<?php

namespace Database\Seeders\Tenant;

use App\Models\ROSubscription;
use App\Models\Subscription;
use App\Models\Tenant\RestaurantUser;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ROSubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ROSubscription::create([
            "start_at" => Carbon::yesterday(),
            "end_at" => Carbon::next(1000),
            'amount' => 1,
            "number_of_branches" => 1,
            "user_id" => RestaurantUser::find(UserSeeder::RESTAURANT_CUSTOMER_USER_ID)->id,
            'status' => ROSubscription::ACTIVE,
            'type' => ROSubscription::NEW,
            'subscription_id' => Subscription::first()->id
        ]);
    }
}
