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
    public const PAYMENT_METHOD_COD = 1;
    public const PAYMENT_METHOD_CC = 2;

    public function run(): void
    {
        PaymentMethod::create([
            'id'=> self::PAYMENT_METHOD_COD,
            'name'=> PaymentMethod::CASH_ON_DELIVERY,
            'is_active'=>true,
        ]);
        PaymentMethod::create([
            'id'=> self::PAYMENT_METHOD_CC,
            'name'=>PaymentMethod::CREDIT_CARD,
            'is_active'=>true,
        ]);
     
    }
}
