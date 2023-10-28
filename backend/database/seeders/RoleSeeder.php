<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure that you're on the central connection.
       /* $previousConnection = config('database.default');
        config(['database.default' => 'tenancy.central_connection']);*/

        // Create roles
        $roles = ['Administrator', 'Restaurant Owner'];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        // Switch back to the previous connection.
      //  config(['database.default' => $previousConnection]);
    }
}
