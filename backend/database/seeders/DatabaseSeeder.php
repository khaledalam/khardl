<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(TenantsTableSeeder::class);
        $this->call(DomainsTableSeeder::class);
        $this->call([
            RoleSeeder::class,
            TenantRoleSeeder::class,
            PermissionSeeder::class
        ]);
        $this->call(OauthClientsTableSeeder::class);
        $this->call(OauthPersonalAccessClientsTableSeeder::class);
    }
}
