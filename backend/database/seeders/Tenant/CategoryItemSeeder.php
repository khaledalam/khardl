<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant\Branch;
use App\Models\Tenant\Category;
use App\Models\Tenant\Item;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class CategoryItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $faker = new Generator();

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
                foreach (range(2, 5) as $k => $it) {

                    // use khardl logo from public folder
            //        $logo_file = new UploadedFile(global_asset('img/logo.png'), true);
            //        $logo = store_image($logo_file,RestaurantStyle::STORAGE,'logo');

                    $category->items()->save(new Item([
                        'photo' => '',
                        'price' => $faker->numberBetween(10, 500),
                        'calories' => $faker->numberBetween(0, 500),
                        'description' =>  trans_json("Item " . $k+1,"Item " . $k+1),
                        'availability'=> (bool)$faker->numberBetween(0, 1),
                        'branch_id' => $branch->id,
                        'user_id'=>UserSeeder::RESTAURANT_WORKER_USER_ID
                    ]));
                }
            }

        }
    }
}
