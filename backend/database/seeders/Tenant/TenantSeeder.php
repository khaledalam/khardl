<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;
use App\Actions\CreateTenantAction;
use App\Models\Tenant;

class TenantSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $restaurant_name = Tenant::latest()->first()->restaurant_name;
        $assets = tenant_route(
        // subdomain
            CreateTenantAction::generateSubdomain($restaurant_name)
        // domain
            .'.'.config("tenancy.central_domains")[0]
        // route
            ,'stancl.tenancy.asset') . '/';

        $this->call([
            SettingSeeder::class,
            RolesAndPermissionsSeeder::class,
            RestaurantStyleSeeder::class,

            // Testing seeders
            PaymentMethodSeeder::class,
            DeliveryTypesSeeder::class,
            BranchSeeder::class,


            // make sure BranchSeeder run before UserSeeder
            UserSeeder::class,

            // make sure UserSeeder run before CategoryItemSeeder
            CategoryItemSeeder::class,


            OrderSeeder::class,
        ],false,[
            'assets'=>$assets,
            'restaurant_name'=>$restaurant_name
        ]);

    }
}
