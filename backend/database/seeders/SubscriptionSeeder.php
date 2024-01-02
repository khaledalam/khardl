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
            'term'=>"YEARLY",
            "period"=>0,
            "due"=>0,
            "auto_renew"=>true,
            "amount"=>1
        ]);
    }
}
