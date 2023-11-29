<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;
use Database\Seeders\Tenant\RestaurantStyleSeeder;


class TenantSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            SettingSeeder::class,
            RolesAndPermissionsSeeder::class,
            BranchSeeder::class,
            UserSeeder::class,
            RestaurantStyleSeeder::class,
           
        ]);
        

    }
}
