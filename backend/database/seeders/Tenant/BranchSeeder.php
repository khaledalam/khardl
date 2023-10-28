<?php

namespace Database\Seeders\Tenant;

use App\Models\Branch;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Branch::create([
            'name'      =>trans_json("Branch 1",'فرع رقم ١'),
            'address'   =>trans_json(fake()->address(),fake('ar_SA')->address()),
            'restaurant_id'=> Restaurant::first()->id,
            'phone'     =>"123456789",
            'latitude'  => '32.2',
            'longitude'  => '32.2',
            'is_active' => true,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
    }
}
