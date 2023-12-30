<?php

namespace Database\Seeders;

use App\Models\CentralSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CentralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CentralSetting::create([
            'webhook_url'=>''
        ]);
    }
}
