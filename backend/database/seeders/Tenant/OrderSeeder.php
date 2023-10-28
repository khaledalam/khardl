<?php

namespace Database\Seeders\Tenant;

use App\Models\Branch;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=0;$i<20;$i++){
            Order::create([
                'user_id'=> User::first()->id,
                'branch_id'=> Branch::first()->id,
                'total_price'=> fake()->randomNumber(4, true),
                'status'=>'pending',
                "payment_method"=>"cash",
                'payment_status'=>"pending",
                'shipping_address'=>fake()->address(),
                'created_at'=>now(),
                'updated_at'=>now(),
            ]);
        }
    }
}
