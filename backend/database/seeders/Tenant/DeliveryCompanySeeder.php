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
        // TODO @todo ensure coverage area for every delivery company
        DeliveryCompany::create([
            'name'=> trans_json('Yeswa','يسوى'),
            'coverage_km'=>10,
            'coverage_area'=>trans_json(['Riyadh', 'Jeddah','Mecca','Dammam','Al-Ahsa'],['الرياض', 'جده','مكه','الدمام','ٱلْحِسَى']),
            'api_url'=>"http://api.yeswa.net/v1",
            'module'=> class_basename(Yeswa::class) // cannot be override 
        ]);
        DeliveryCompany::create([
            'name'=> trans_json('Cervo','سيرفو'),
            'api_url'=>"https://carvo.isoft4is.com/apis/v2",
            'coverage_km'=>16,
            'coverage_area'=>trans_json(['Riyadh', 'Jeddah','Mecca','Dammam','Al-Ahsa'],['الرياض', 'جده','مكه','الدمام','ٱلْحِسَى']),
            'module'=>class_basename(Cervo::class) // cannot be override 
        ]);
        DeliveryCompany::create([
            'name'=> trans_json('Street Line','ستريت لاين'),
            'api_url'=>"https://api.streetline.app/a",
            'coverage_km'=>10,
            'coverage_area'=>trans_json([
                'Riyadh',
                'Jeddah',
                'Mecca',
                'Dammam',
                'Al-Ahsa',
                'Khobar',
                'Dahran',
                'Hassa',
                'Buridah',
                'Tabuk',
                'Al Madinah',
                'Yanbu',
                'Makkah',
                'Taif',
                'Abha',
                'Khamis Mashit',
                'Bulgrshi',
                'Kharj'
            ],[
                'الرياض',
                'جده',
                'مكه',
                'الدمام',
                'ٱلْحِسَى',
                'الخبر',
                'الظهران',
                'الاحساء',
                'بريدة',
                'تبوك',
                'ينبع',
                'الطائف',
                'ابها',
                'الخرج',
                'المدينة',
                'خميس مشيط',
                'بلجرشي'
            ]),
            'module'=>class_basename(StreetLine::class) // cannot be override 
        ]);
           


     
    }
}
