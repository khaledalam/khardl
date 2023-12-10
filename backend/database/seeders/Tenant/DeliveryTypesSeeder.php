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
    public const DELIVERY_TYPE_PICKUPـ_BY_CAR = 3;

    public const DELIVERY_TYPE_B_PICKUP = 3;

    public function run(): void
    {
        DeliveryType::create([
            'id' => self::DELIVERY_TYPE_DELIVERY,
            'name' => DeliveryType::DELIVERY,
            'cost' => 19.5
        ]);
        DeliveryType::create([
            'id' => self::DELIVERY_TYPE_PICKUP,
            'name' => DeliveryType::PICKUP,
            'cost' => 0
        ]);
        DeliveryType::create([
            'id' => self::DELIVERY_TYPE_PICKUPـ_BY_CAR,
            'name' => DeliveryType::PICKUP_BY_CAR,
            'cost' => 0
        ]);

        DeliveryType::create([
            'id' => self::DELIVERY_TYPE_B_PICKUP,
            'name' => DeliveryType::PICKUP,
            'cost' => 0
        ]);

    }
}
