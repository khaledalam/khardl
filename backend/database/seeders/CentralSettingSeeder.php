<?php

namespace Database\Seeders;

use App\Models\CentralSetting;
use Illuminate\Database\Seeder;

class CentralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CentralSetting::create([
            'webhook_url' => '',
            'live_chat_enabled' => false,
            'new_branch_slot_price' => 0,
            'fee_flat_rate' => 0,
            'fee_percentage' => 0
        ]);
    }
}
