<?php

namespace Database\Seeders\Tenant;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Restaurant::create([
            'name'    =>trans_json("Restaurant 1",'مطعم رقم ١'),
            'address' =>fake()->address(),
            'city'    =>fake()->city(),
            'state'   =>fake()->city(),
            'zipcode' =>"#AAAAA",
            'phone'   =>"#AAAAA",
            'status'  => 'open',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
    }
}
