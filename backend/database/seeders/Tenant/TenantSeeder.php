<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;


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
           
        ]);
        

    }
}
