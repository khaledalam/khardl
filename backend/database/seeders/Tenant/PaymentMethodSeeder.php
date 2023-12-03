<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant\Order;
use App\Models\Tenant\Branch;
use App\Models\Tenant\PaymentMethod;
use App\Models\Tenant\Setting;
use Illuminate\Database\Seeder;
use App\Models\Tenant\RestaurantUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods = ['online','cash'];
        foreach($methods as $method){
            PaymentMethod::create([
                'name'=>trans_json($method,__($method)),
                'is_active'=>true,
            ]);
        }
     
    }
}
