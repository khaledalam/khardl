<?php

namespace Database\Seeders\Tenant;

use App\Models\ProductSize;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=0;$i<20;$i++){
            ProductSize::create([
                'name'=> trans_json('Size Number '.$i+1,'حجم المنتج رقم '.$i+1),
                'price'=>fake()->randomNumber(2, true),
                'created_at'=>now(),
                'updated_at'=>now(),
           
            ]);
        }
    }
}
