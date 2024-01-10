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
        
        if(env('APP_ENV') == 'local'){
            $seeders= [
                RolesAndPermissionsSeeder::class,
                SettingSeeder::class,
                RestaurantStyleSeeder::class,
                PaymentMethodSeeder::class,
                DeliveryTypesSeeder::class,
                BranchSeeder::class,
                // make sure BranchSeeder run before UserSeeder
                UserSeeder::class,
                // make sure UserSeeder run before CategoryItemSeeder
                CategoryItemSeeder::class,
                OrderSeeder::class,
                DeliveryCompanySeeder::class
            ];
        }else {
            $seeders= [
                RolesAndPermissionsSeeder::class,
                SettingSeeder::class,
                RestaurantStyleSeeder::class,
                PaymentMethodSeeder::class,
                DeliveryTypesSeeder::class,
                DeliveryCompanySeeder::class
            ];
        }
        $this->call($seeders,false,[
            'assets'=>$assets,
            'restaurant_name'=>$restaurant_name
        ]);

    }
}
