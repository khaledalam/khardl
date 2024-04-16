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
            'description'=>trans_json('For each branch annually','لكل فرع سنوياً'),
            "amount"=>400
        ]);
        Subscription::create([
            'name'=>trans_json('Customer app','تطبيق الزبون'),
            'description'=>trans_json('Customer application','تطبيق الزبون'),
            "amount"=>400
        ]);
    }
}
