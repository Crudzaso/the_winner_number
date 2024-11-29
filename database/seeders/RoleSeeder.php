<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $participantRole = Role::create(['name' => 'participant']);
        $organizerRole = Role::create(['name' => 'organizer']);
        $adminRole = Role::create(['name' => 'admin']);

        Permission::create(['name' => 'raffles.index'])->syncRoles([$participantRole, $organizerRole, $adminRole]);
        Permission::create(['name' => 'raffles.show'])->syncRoles([$participantRole, $organizerRole, $adminRole]);
        Permission::create(['name' => 'purchases.index'])->syncRoles([$participantRole, $organizerRole, $adminRole]);
        Permission::create(['name' => 'purchases.store'])->syncRoles([$participantRole, $organizerRole]);
        Permission::create(['name' => 'purchases.show'])->syncRoles([$participantRole, $organizerRole, $adminRole]);

        Permission::create(['name' => 'raffles.myindex'])->syncRoles([$organizerRole]);
        Permission::create(['name' => 'raffles.store'])->syncRoles([$organizerRole]);
        Permission::create(['name' => 'raffles.edit'])->syncRoles([$organizerRole, $adminRole]);
        Permission::create(['name' => 'raffles.destroy'])->syncRoles([$organizerRole, $adminRole]);
        Permission::create(['name' => 'purchases.sales'])->syncRoles([$organizerRole]);

        Permission::create(['name' => 'admin.users.index'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'admin.users.store'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'admin.users.edit'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'admin.users.destroy'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'admin.roles.index'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'admin.roles.store'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'admin.roles.edit'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'admin.roles.destroy'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'admin.permissions.index'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'admin.permissions.store'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'admin.permissions.edit'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'admin.permissions.destroy'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'admin.raffles.destroy'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'admin.purchases.allpurchases'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'admin.purchases.edit'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'admin.purchases.destroy'])->syncRoles([$adminRole]);
    }
}
