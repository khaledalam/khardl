<?php

namespace Database\Seeders;

use App\Models\Subscription;
use App\Models\TraderRequirement;
use App\Models\User;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubscriptionSeeder extends Seeder
{
 
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subscription::create([
            'name'=>trans_json('Default Package','الباقة التقليدية'),
            "amount"=>400
        ]);
    }
}
