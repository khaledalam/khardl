<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($assets,$restaurant_name): void
    {
        Setting::create([
            'is_live' => true,
            'delivery_fee' => 0,
            'restaurant_name'=>$restaurant_name
        ]);
    }
}
