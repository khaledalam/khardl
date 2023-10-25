<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TenantsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tenants')->delete();
        
        \DB::table('tenants')->insert(array (
            0 => 
            array (
                'id' => 'first',
                'created_at' => '2023-10-01 19:55:47',
                'updated_at' => '2023-10-01 19:55:47',
                'data' => '{"tenancy_db_name": "restaurantfirst"}',
            ),
        ));
        
        
    }
}