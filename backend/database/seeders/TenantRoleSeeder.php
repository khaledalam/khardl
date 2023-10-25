<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class TenantRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all tenants
        $tenants = Tenant::all();

        foreach ($tenants as $tenant) {
            // Switch to the tenant's database
            tenancy()->initialize($tenant);

            // Create roles
            $roles = ['Administrator', 'Branch Admin', 'Casher'];

            foreach ($roles as $role) {
                Role::firstOrCreate(['name' => $role]);
            }
        }

        // Ensure that you revert to the central connection after all tenants are seeded.
        tenancy()->end();
    }
}
