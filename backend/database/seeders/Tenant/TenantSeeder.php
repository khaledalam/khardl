<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;
use Laravel\Passport\ClientRepository;
use Database\Seeders\OauthClientsTableSeeder;
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
        $client = new ClientRepository();

        $client->createPasswordGrantClient(null, 'Default password grant client', 'http://your.redirect.path');
        $client->createPersonalAccessClient(null, 'Default personal access client', 'http://your.redirect.path');


    }
}
