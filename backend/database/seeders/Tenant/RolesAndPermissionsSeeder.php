<?php

namespace Database\Seeders\Tenant;

use App\Models\User;
use App\Models\Domain;
use App\Models\Tenant;
use App\Models\Tenant\Branch;
use App\Models\Tenant\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        
        $roles = ['Restaurant Owner','Worker']; // Customer does not have any roles for now
        

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        $permissions = collect([
            'view ',
            'view own ',
            'manage ',
            'manage own ',                
        ]);

        $Modules = collect([
            User::class,
            Branch::class,
            Category::class,
        ]);

        $Modules->each(function ($item)use($permissions) {
            $name = $this->getPermissionName($item);
            // create permissions for each collection item
            $permissions->each(function($permission)use($name){
                Permission::create(['guard_name' => "web", 'group' => $name, 'name' => $permission.$name]);
            });
        });

        // Assign all permissions to the 'Administrator' role
        $adminRole = Role::findByName('Restaurant Owner');
        $adminRole->givePermissionTo(Permission::all());

        
    }
      /**
     * Get permission name based on the model class provided
     *
     * @param $class
     *
     * @return string
     */
    private function getPermissionName($class)
    {
        return Str::plural(Str::snake(class_basename($class), ' '));
    }
}
