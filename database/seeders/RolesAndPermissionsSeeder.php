<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

            // create permissions
            Permission::create(['name' => 'create admin']);
            Permission::create(['name' => 'delete admin']);
            Permission::create(['name' => 'view admin']);
            Permission::create(['name' => 'update admin']);
            Permission::create(['name' => 'edit admin']);

            // create permissions
            Permission::create(['name' => 'create manager']);
            Permission::create(['name' => 'edit manager']);
            Permission::create(['name' => 'view manager']);
            Permission::create(['name' => 'update manager']);
            Permission::create(['name' => 'delete manager']);


            // assign created permissions
            $role = Role::create(['name' => 'admin']);
                $role->givePermissionTo(['create manager', 'edit manager', 'update manager', 'delete manager']);

            $role2 = Role::create(['name' => 'super-admin']);
            $role2->givePermissionTo(Permission::all());
            
            Role::create(['name' => 'estate-manager']);

            Role::create(['name' => 'security-company']);

            Role::create(['name' => 'security-guard']);

            Role::create(['name' => 'resident']);
    }
}
