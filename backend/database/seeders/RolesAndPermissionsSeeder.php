<?php

namespace Database\Seeders;

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

        $roles = ['Administrator', 'Restaurant Owner'];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        $permissions = collect([
            'create',
            'update',
            'view',
            'delete',
            'forceDelete',
            'restore',
            'view.own',
            'manage',
            'manage.own',                
        ]);

        $Modules = collect([
            User::class,
            Role::class,
            Permission::class,
      
        ]);

        $Modules->each(function ($item)use($permissions) {
            $name = $this->getPermissionName($item);
            // create permissions for each collection item
            $permissions->each(function($permission)use($name){
                Permission::create(['guard_name' => "web", 'group' => $name, 'name' => $permission.'.'.$name]);
            });
        });

        // Assign all permissions to the 'Administrator' role
        $adminRole = Role::findByName('Administrator');
        $adminRole->givePermissionTo(Permission::where('name'));

        
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
