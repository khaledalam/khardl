<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\Tenant\UserSeeder;
use Database\Seeders\Tenant\OrderSeeder;
use Database\Seeders\Tenant\BranchSeeder;
use Database\Seeders\Tenant\ProductSeeder;
use Database\Seeders\Tenant\CategorySeeder;
use Database\Seeders\Tenant\OrderItemSeeder;
use Database\Seeders\Tenant\RestaurantSeeder;
use Database\Seeders\Tenant\ProductSizeSeeder;
use Database\Seeders\Tenant\RolesAndPermissionsSeeder;

class TenantsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        
        $this->call([
            RolesAndPermissionsSeeder::class,
            UserSeeder::class,
            RestaurantSeeder::class,
            BranchSeeder::class,
            OrderSeeder::class,
            CategorySeeder::class,
            ProductSizeSeeder::class,
            ProductSeeder::class,
            OrderItemSeeder::class
        ]);

        
    }
}