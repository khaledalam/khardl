<?php

namespace Database\Seeders\Tenant;

use Carbon\Carbon;
use App\Models\Tenant\Branch;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{

    public const BRANCH_ID = 1;
    public const BRANCH_B_ID = 2;


    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = (new Factory())::create();

        // This branch has pickup and delivery
        $currentDateTime = Carbon::now();
        $branch = Branch::create([
            'id' => self::BRANCH_ID,
            'name' => 'Branch 1',
            'city' => $faker->city,
            'neighborhood' => $faker->streetAddress,
            'lat' => '37.7',
            'lng' => '37.7',
            'phone'=> '966123456789',
            'address'=>"Riyadh",
            'is_primary' => true,
            'saturday_open' => $currentDateTime->format('H:i'),
            'saturday_close' => $currentDateTime->addHour()->format('H:i'),
            'sunday_open' => $currentDateTime->format('H:i'),
            'sunday_close' => $currentDateTime->addHour()->format('H:i'),
            'monday_open' => $currentDateTime->format('H:i'),
            'monday_close' => $currentDateTime->addHour()->format('H:i'),
            'tuesday_open' => $currentDateTime->format('H:i'),
            'tuesday_close' => $currentDateTime->addHour()->format('H:i'),
            'wednesday_open' => $currentDateTime->format('H:i'),
            'wednesday_close' => $currentDateTime->addHour()->format('H:i'),
            'thursday_open' => $currentDateTime->format('H:i'),
            'thursday_close' => $currentDateTime->addHour()->format('H:i'),
            'friday_open' => $currentDateTime->format('H:i'),
            'friday_close' => $currentDateTime->addHour()->format('H:i'),
            'pickup_availability' => $faker->boolean
        ]);
        $branch->payment_methods()->sync([
            PaymentMethodSeeder::PAYMENT_METHOD_COD,
            PaymentMethodSeeder::PAYMENT_METHOD_CC
        ]);
        $branch->delivery_types()->sync([
            DeliveryTypesSeeder::DELIVERY_TYPE_DELIVERY,
            DeliveryTypesSeeder::DELIVERY_TYPE_PICKUP
        ]);



        // This branch has pickup only
        $branch2 = Branch::create([
            'id' => self::BRANCH_B_ID,
            'name' => 'Branch 2',
            'address'=>"Riyadh",
            'city' => $faker->city,
            'neighborhood' => $faker->streetAddress,
            'lat' => '27.7',
            'lng' => '27.7',
            'phone'=> '966123456789',
            'is_primary' => false,
            'saturday_open' => $currentDateTime->format('H:i'),
            'saturday_close' => $currentDateTime->addHour()->format('H:i'),
            'sunday_open' => $currentDateTime->format('H:i'),
            'sunday_close' => $currentDateTime->addHour()->format('H:i'),
            'monday_open' => $currentDateTime->format('H:i'),
            'monday_close' => $currentDateTime->addHour()->format('H:i'),
            'tuesday_open' => $currentDateTime->format('H:i'),
            'tuesday_close' => $currentDateTime->addHour()->format('H:i'),
            'wednesday_open' => $currentDateTime->format('H:i'),
            'wednesday_close' => $currentDateTime->addHour()->format('H:i'),
            'thursday_open' => $currentDateTime->format('H:i'),
            'thursday_close' => $currentDateTime->addHour()->format('H:i'),
            'friday_open' => $currentDateTime->format('H:i'),
            'friday_close' => $currentDateTime->addHour()->format('H:i'),
        ]);

      $branch2->delivery_types()->sync([
          DeliveryTypesSeeder::DELIVERY_TYPE_DELIVERY,
          DeliveryTypesSeeder::DELIVERY_TYPE_PICKUP,
//          DeliveryTypesSeeder::DELIVERY_TYPE_PICKUP_BY_CAR,
      ]);
      $branch2->payment_methods()->sync([
          PaymentMethodSeeder::PAYMENT_METHOD_COD,
          PaymentMethodSeeder::PAYMENT_METHOD_CC

      ]);

    }
}
