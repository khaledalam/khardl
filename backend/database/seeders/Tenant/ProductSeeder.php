<?php

namespace Database\Seeders\Tenant;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=0;$i<20;$i++){
            Product::create([
                'name'=> trans_json("Product ".$i+1,'منتج رقم '.$i+1),
                'sku'=>fake()->uuid(),
                'price'=>fake()->randomNumber(4,false),
                'quantity'=>fake()->randomNumber(1, true),
                'status'=>'active',
                'category_id'=>Category::where('parent_id','!=',null)->inRandomOrder()->first()->id,
                'created_at'=>now(),
                'updated_at'=>now(),
            ]);
        }
    }
}
