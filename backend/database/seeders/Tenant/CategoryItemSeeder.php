<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant\Branch;
use App\Models\Tenant\Category;
use App\Models\Tenant\Item;
use App\Models\Tenant\RestaurantStyle;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class CategoryItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run($assets): void
    {
        $faker = new Generator();

        foreach(Branch::all() as $branch){

            $branch->categories()->saveMany([

                new Category([
                    'name' => trans_json('First Category',__('First Category',[],'ar') . ' branch ' . $branch->id ),
                    'user_id' => UserSeeder::RESTAURANT_WORKER_USER_ID,
                    'branch_id' => BranchSeeder::BRANCH_ID
                ]),
                new Category([
                    'name' => trans_json( 'Second Category',__( 'Second Category',[],'ar') . ' branch ' . $branch->id),
                    'user_id' => UserSeeder::RESTAURANT_WORKER_USER_ID,
                    'branch_id' => BranchSeeder::BRANCH_ID
                ]),
                new Category([
                    'name' => trans_json('Third Category',__('Third Category',[],'ar') . ' branch ' . $branch->id),
                    'user_id' => UserSeeder::RESTAURANT_WORKER_USER_ID,
                    'branch_id' => BranchSeeder::BRANCH_B_ID
                ]),
            ]);


            foreach($branch->categories as $key => $category){
                foreach (range(1, 10) as $k => $it) {
                    $kk = $k + 1;
                    $photo_file = new UploadedFile(public_path(Item::STORAGE_SEEDER."/$kk.jpg"), true);
                    $photo = store_image($photo_file,Item::STORAGE_SEEDER,$kk);
                    $category->items()->save(new Item([
                        'photo' => $assets.$photo,
                        'price' => $faker->numberBetween(10, 500),
                        'calories' => $faker->numberBetween(0, 500),
                        'name' =>  trans_json("Item " . $kk,"Item " . $kk),
                        'description' =>  trans_json("Description " . $kk,"Description " . $kk),

                        'availability'=> (bool)$faker->numberBetween(0, 1),
                        'branch_id' => $branch->id,
                        'user_id'=>UserSeeder::RESTAURANT_WORKER_USER_ID
                    ]));
                }
            }

        }
    }
}
