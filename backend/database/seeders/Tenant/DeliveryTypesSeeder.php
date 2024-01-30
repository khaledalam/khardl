<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant\DeliveryType;
use Illuminate\Database\Seeder;

class DeliveryTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public const DELIVERY_TYPE_DELIVERY = 1;
    public const DELIVERY_TYPE_PICKUP = 2;
//    public const DELIVERY_TYPE_PICKUP_BY_CAR = 3;

    public function run(): void
    {
        DeliveryType::create([
            'id' => self::DELIVERY_TYPE_DELIVERY,
            'name' => DeliveryType::DELIVERY,
            'cost' => 50,
            'is_active' => false,
            'helper_message' => __('messages.you are not signed with any delivery company yet')
        ]);
        DeliveryType::create([
            'id' => self::DELIVERY_TYPE_PICKUP,
            'name' => DeliveryType::PICKUP,
            'cost' => 0
        ]);
//        DeliveryType::create([
//            'id' => self::DELIVERY_TYPE_PICKUP_BY_CAR,
//            'name' => DeliveryType::PICKUP_BY_CAR,
//            'cost' => 0
//        ]);

    }
}
