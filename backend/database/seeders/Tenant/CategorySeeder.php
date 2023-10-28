<?php

namespace Database\Seeders\Tenant;

use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $name=fake()->company();
        $name_ar=fake('ar_SA')->company();
        $category=Category::create($this->data($name,$name_ar));
        $parent_id = $category->id;
        for($i=1;$i<=20;$i++){
            $name=fake()->company();
            $name_ar=fake('ar_SA')->company();
            if($i%5 == 0) {
                $category=  Category::create($this->data($name,$name_ar));
                $parent_id = $category->id;
            }else {
                Category::create($this->data($name,$name_ar,$parent_id));
            }
            
        }
    }
    public function data($name,$name_ar,$parent_id= null){
        return [
            'parent_id'=>$parent_id,
            'restaurant_id'=> Restaurant::first()->id,
            'name'=> trans_json($name,$name_ar),
            'slug'=>trans_json(Str::slug($name),Str::slug($name_ar,'-','ar')),
            "order"=>1,
            'created_at'=>now(),
            'updated_at'=>now()
        ];
    }
}
