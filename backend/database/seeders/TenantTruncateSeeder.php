<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TenantTruncateSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tenants')->delete();
        
        \DB::table('tenants')->insert([
                'id' => 'first',
                'email' => env("NOVA_ADMIN_EMAIL","khardl@admin.com"),
                'subscription_id'=>null,
                'user_id'=> 1,
                'created_at' => '2023-10-01 19:55:47',
                'updated_at' => '2023-10-01 19:55:47',
                'data' => '{"tenancy_db_name": "restaurantfirst"}',
        ]);
        
        
        
    }
}