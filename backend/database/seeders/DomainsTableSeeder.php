<?php

namespace Database\Seeders;

use App\Models\Domain;
use App\Models\Tenant;
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
        
        Domain::create([
            'id' => 1,
            'domain' => 'first.'.config('tenancy.central_domains')[0],
            'tenant_id' => Tenant::first()->id,
            'created_at' => '2023-10-01 19:55:57',
            'updated_at' => '2023-10-01 19:55:57',
        ]);
        
        
    }
}