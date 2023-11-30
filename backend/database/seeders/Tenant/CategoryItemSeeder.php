<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant\Branch;
use App\Models\Tenant\Category;
use App\Models\Tenant\Item;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class CategoryItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        foreach(Branch::all() as $branch){
            $branch->categories()->saveMany([
                new Category([
                    'name' => trans_json('First Category',__('First Category',[],'ar')),
                    'user_id'=>UserSeeder::RESTAURANT_WORKER_USER_ID,
                    'branch_id'=>BranchSeeder::BRANCH_ID
                ]),
                new Category([
                    'name' => trans_json( 'Second Category',__( 'Second Category',[],'ar')),
                    'user_id'=>UserSeeder::RESTAURANT_WORKER_USER_ID,
                    'branch_id'=>BranchSeeder::BRANCH_ID
                ]),
            ]);
            foreach($branch->categories as $key=>$category){
                $category->items()->save(new Item([
                    'photo' => '',
                    'price' => 200,
                    'calories' => 1000,
                    'description' =>  trans_json("Item ".$key+1,"Item ".$key+1),
                    'user_id' => Auth::id(),
                    'availability'=>true,
                    'branch_id' => $branch->id,
                    'user_id'=>UserSeeder::RESTAURANT_WORKER_USER_ID
                ]));
            }
         
        }
    }
}
