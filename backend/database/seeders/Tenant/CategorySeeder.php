<?php

namespace Database\Seeders\Tenant;

use Illuminate\Support\Str;
use App\Models\Tenant\Branch;
use App\Models\Tenant\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run(): void
    {
        $name=fake()->company();
        $name_ar=fake('ar_SA')->company();
        $category=Category::create($this->data(0,$name,$name_ar));
        $parent_id = $category->id;
        for($i=1;$i<=20;$i++){
            $name=fake()->company();
            $name_ar=fake('ar_SA')->company();
            if($i%5 == 0) {
                $category=  Category::create($this->data($i,$name,$name_ar));
                $parent_id = $category->id;
            }else {
                Category::create($this->data($i,$name,$name_ar,$parent_id));
            }
            
        }
    }
    public function data($i,$name,$name_ar,$parent_id= null){
        return [
            'parent_id'=>$parent_id,
            'name'=> trans_json($name,$name_ar),
            'slug'=>trans_json(Str::slug($name),Str::slug($name_ar,'-','ar')),
            "sort_order"=>$i,
            "branch_id"=> Branch::first()->id,
        ];
    }
    
}