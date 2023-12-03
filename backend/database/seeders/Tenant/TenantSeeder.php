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
            RestaurantStyleSeeder::class,

            // Testing seeders
            BranchSeeder::class,


            // make sure BranchSeeder run before UserSeeder
            UserSeeder::class,

            // make sure UserSeeder run before CategoryItemSeeder
            CategoryItemSeeder::class,

            PaymentMethodSeeder::class,
            OrderSeeder::class,
        ]);

    }
}
