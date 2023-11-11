<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;
use Database\Seeders\Tenant\UserSeeder;
use Database\Seeders\Tenant\RolesAndPermissionsSeeder;

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
            RolesAndPermissionsSeeder::class,
            UserSeeder::class,
        ]);
      

        
    }
}