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
    public function run(): void
    {
        Setting::create([
            'is_live'=>true
        ]);
    }
}
