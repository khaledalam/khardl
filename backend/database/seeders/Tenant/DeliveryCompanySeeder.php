<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant\DeliveryCompany;
use App\Packages\DeliveryCompanies\Cervo\Cervo;
use App\Packages\DeliveryCompanies\StreetLine\StreetLine;
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
            'coverage_km'=>10,
            'api_url'=>"http://api.yeswa.net/v1",
            'module'=> class_basename(Yeswa::class) // cannot be override 
        ]);
        DeliveryCompany::create([
            'name'=> trans_json('Cervo','سيرفو'),
            'api_url'=>"https://carvo.isoft4is.com/apis/v2",
            'coverage_km'=>16,
            'module'=>class_basename(Cervo::class) // cannot be override 
        ]);
        DeliveryCompany::create([
            'name'=> trans_json('Street Line','ستريت لاين'),
            'api_url'=>"https://api.streetline.app/a",
            'coverage_km'=>10,
            'module'=>class_basename(StreetLine::class) // cannot be override 
        ]);


     
    }
}
