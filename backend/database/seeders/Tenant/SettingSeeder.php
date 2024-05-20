<?php

namespace Database\Seeders\Tenant;

use App\Models\CentralTenantSetting;
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
            'id' => CentralTenantSetting::latest()->first()?->id + 1,
            'loyalty_points' => 0,
            'cashback_threshold'    => 0,
            'cashback_percentage'   => 0,
            'is_live' => false,
            'delivery_fee' => 0,
            'restaurant_name'=>$restaurant_name
        ]);
    }
}
