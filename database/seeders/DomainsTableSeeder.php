<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DomainsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('domains')->delete();
        
        \DB::table('domains')->insert(array (
            0 => 
            array (
                'id' => 1,
                'domain' => 'first.khardl-back.test',
                'tenant_id' => 'first',
                'created_at' => '2023-10-01 19:55:57',
                'updated_at' => '2023-10-01 19:55:57',
            ),
        ));
        
        
    }
}