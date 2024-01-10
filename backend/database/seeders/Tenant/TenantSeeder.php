<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant;
use Illuminate\Database\Seeder;
use App\Actions\CreateTenantAction;
use Database\Seeders\Tenant\DeliveryCompanySeeder;

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
            RolesAndPermissionsSeeder::class,
            SettingSeeder::class,
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
            DeliveryCompanySeeder::class
        ],false,[
            'assets'=>$assets,
            'restaurant_name'=>$restaurant_name
        ]);

    }
}
