<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;
use Laravel\Passport\ClientRepository;
use Database\Seeders\Tenant\UserSeeder;
use Database\Seeders\Tenant\BranchSeeder;
use Database\Seeders\OauthClientsTableSeeder;
use Database\Seeders\Tenant\RolesAndPermissionsSeeder;
use Database\Seeders\OauthPersonalAccessClientsTableSeeder;

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
            BranchSeeder::class,
            UserSeeder::class,
        ]);
        $this->call(OauthClientsTableSeeder::class);
        $this->call(OauthPersonalAccessClientsTableSeeder::class);

        
    }
}