<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
       
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $roles = ['Restaurant Owner', 'Worker'];
        $collection = collect([
            User::class,
            Role::class,
            Permission::class,
            LaraBuilder::class,
            TenantSettings::class
            // ... // List all your Models you want to have Permissions for.
        ]);



        $collection->each(function ($item, $key) {
            // create permissions for each collection item
            $group = $this->getGroupName($item);
            $permission = $this->getPermissionName($item);

            Permission::create([
            'group' => $group,
            'name' =>  $permission . '.view',
            'name_ar' =>   __("model view",["name"=>__($permission)]),
            'description' =>__("Allow the user to view a list of as well as the details",["name"=>__(strtolower($group))])
            ]);
            Permission::create([
                'group' => $group,
                'name' =>  $permission . '.create',
                'name_ar' =>   __("model create",["name"=>__($permission)]),
                'description' => __("Allow the user to add new",["name"=>__(strtolower($group))])
            ]);
            Permission::create([
                'group' => $group,
                'name' =>  $permission . '.update',
                'name_ar' =>   __("model update",["name"=>__($permission)]),
                'description' => __("Allow the user to update existing",["name"=>__(strtolower($group))])
            ]);
            Permission::create([
                'group' => $group,
                'name' =>  $permission . '.delete',
                'name_ar' =>   __("model delete",["name"=>__($permission)]),
                'description' => __("Allow the user to delete",["name"=>__(strtolower($group))])
            ]);
            Permission::create([
                'group' => $group,
                'name' =>  $permission . '.restore',
                'name_ar' =>   __("model restore",["name"=>__($permission)]),
                'description' => __("Allow the user to restore",["name"=>__(strtolower($group))])
            ]);
            Permission::create([
                'group' => $group,
                'name' =>  $permission . '.forceDelete',
                'name_ar' =>   __("model forceDelete",["name"=>__($permission)]),
                'description' => __("Allow the user to forceDelete",["name"=>__(strtolower($group))])
            ]);
            Permission::create([
                'group' => $group,
                'name' =>  $permission . '.manage',
                'name_ar' =>   __("model manage",["name"=>__($permission)]),
                'description' =>__("Allow the user to manage his models",["name"=>__(strtolower($group))])
            ]);
        });

        // Create an Admin Role and assign all Permissions
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

       // Give User Admin Role
        $user = User::first(); // Change this to your email.
        $user->assignRole('admin');
    }

    /**
     * Get group name based on the model class provided
     *
     * @param $class
     *
     * @return string
     */
    private function getGroupName($class)
    {
        return Str::plural(Str::title(Str::snake(class_basename($class), ' ')));
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
