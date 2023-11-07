<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    protected $map = [
        ["lat" => 31.59755792725164, "lng" => 34.488574362357234],
        ["lat" => 31.541395429112008, "lng" => 34.565478659232234],
        ["lat" => 31.510959956638967, "lng" => 34.54762587602911],
        ["lat" => 31.5039349778517, "lng" => 34.51192030962286],
        ["lat" => 31.380912447299117, "lng" => 34.37184462602911],
        ["lat" => 31.3656698557472, "lng" => 34.367724752982234],
        ["lat" => 31.30115462057891, "lng" => 34.37459120806036],
        ["lat" => 31.28472550116475, "lng" => 34.35536513384161],
        ["lat" => 31.277683573489185, "lng" => 34.33613905962286],
        ["lat" => 31.261250364243736, "lng" => 34.326526022513484],
        ["lat" => 31.222503620707172, "lng" => 34.263354635794734],
        ["lat" => 31.32696602162243, "lng" => 34.22078261431036],
        ["lat" => 31.45064504481349, "lng" => 34.36154494341192],
    ];
    public function run()
    {
        Branch::create([
            'name'      =>trans_json("Branch 1",'فرع رقم ١'),
            'address'   =>trans_json(fake()->address(),fake('ar_SA')->address()),
            'phone'     =>"123456789",
            'email'     =>"test@test.com",
            'map'       => $this->map, 
            'is_active' => true,
        ]);
    }
    
}