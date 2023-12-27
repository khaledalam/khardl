<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant\DeliveryCompany;
use App\Packages\DeliveryCompanies\Cervo\Cervo;
use App\Packages\DeliveryCompanies\Yeswa\Yeswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliveryCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DeliveryCompany::create([
            'name'=> trans_json('Yeswa','يسوى'),

            'Module'=> class_basename(Yeswa::class) // cannot be override 
        ]);
        DeliveryCompany::create([
            'name'=> trans_json('Cervo','سيرفو'),
            
            'Module'=>class_basename(Cervo::class) // cannot be override 
        ]);

     
    }
}
