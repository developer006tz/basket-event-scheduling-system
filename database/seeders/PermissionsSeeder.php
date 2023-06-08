<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list allcoaches']);
        Permission::create(['name' => 'view allcoaches']);
        Permission::create(['name' => 'create allcoaches']);
        Permission::create(['name' => 'update allcoaches']);
        Permission::create(['name' => 'delete allcoaches']);

        Permission::create(['name' => 'list alleventstatistics']);
        Permission::create(['name' => 'view alleventstatistics']);
        Permission::create(['name' => 'create alleventstatistics']);
        Permission::create(['name' => 'update alleventstatistics']);
        Permission::create(['name' => 'delete alleventstatistics']);

        Permission::create(['name' => 'list alleventtypes']);
        Permission::create(['name' => 'view alleventtypes']);
        Permission::create(['name' => 'create alleventtypes']);
        Permission::create(['name' => 'update alleventtypes']);
        Permission::create(['name' => 'delete alleventtypes']);

        Permission::create(['name' => 'list allgames']);
        Permission::create(['name' => 'view allgames']);
        Permission::create(['name' => 'create allgames']);
        Permission::create(['name' => 'update allgames']);
        Permission::create(['name' => 'delete allgames']);

        Permission::create(['name' => 'list allnotifications']);
        Permission::create(['name' => 'view allnotifications']);
        Permission::create(['name' => 'create allnotifications']);
        Permission::create(['name' => 'update allnotifications']);
        Permission::create(['name' => 'delete allnotifications']);

        Permission::create(['name' => 'list allplayers']);
        Permission::create(['name' => 'view allplayers']);
        Permission::create(['name' => 'create allplayers']);
        Permission::create(['name' => 'update allplayers']);
        Permission::create(['name' => 'delete allplayers']);

        Permission::create(['name' => 'list allpractices']);
        Permission::create(['name' => 'view allpractices']);
        Permission::create(['name' => 'create allpractices']);
        Permission::create(['name' => 'update allpractices']);
        Permission::create(['name' => 'delete allpractices']);

        Permission::create(['name' => 'list allteams']);
        Permission::create(['name' => 'view allteams']);
        Permission::create(['name' => 'create allteams']);
        Permission::create(['name' => 'update allteams']);
        Permission::create(['name' => 'delete allteams']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
