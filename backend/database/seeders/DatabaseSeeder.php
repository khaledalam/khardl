<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Domain;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      
        // Central 
        $this->call([
            RolesAndPermissionsSeeder::class,
            UserSeeder::class
        ]);
        // Tenant
        $this->call(TenantSeeder::class);
        // Passport tokens
        $this->call(OauthClientsTableSeeder::class);
        $this->call(OauthPersonalAccessClientsTableSeeder::class);
        
    }
}
