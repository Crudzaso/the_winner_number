<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create(['name'=>'participant']);
        $role2 = Role::create(['name'=>'organizer']);
        $role3 = Role::create(['name'=>'admin']);

        Permission::create(['name'=>'participanat.raffles.index'])->syncRoles([$role, $role2, $role3]);
        Permission::create(['name'=>'participanat.raffles.show'])->syncRoles([$role, $role2, $role3]);
        Permission::create(['name'=>'participanat.purchases.index'])->syncRoles([$role, $role2]);
        Permission::create(['name'=>'participanat.purchases.store'])->syncRoles([$role, $role2]);
        Permission::create(['name'=>'participanat.purchases.show'])->syncRoles([$role, $role2, $role3]);

        Permission::create(['name'=>'organizer.raffles.myindex'])->syncRoles([$role2]);
        Permission::create(['name'=>'organizer.raffles.store'])->syncRoles([$role2]);
        Permission::create(['name'=>'organizer.raffles.edit'])->syncRoles([$role2, $role3]);
        Permission::create(['name'=>'organizer.raffles.destroy'])->syncRoles([$role2, $role3]);
        Permission::create(['name'=>'organizer.purchases.allmysales'])->syncRoles([$role2]);

        Permission::create(['name'=>'admin.users.index'])->syncRoles([$role3]);
        Permission::create(['name'=>'admin.users.store'])->syncRoles([$role3]);
        Permission::create(['name'=>'admin.users.edit'])->syncRoles([$role3]);
        Permission::create(['name'=>'admin.users.destroy'])->syncRoles([$role3]);
        Permission::create(['name'=>'admin.roles.index'])->syncRoles([$role3]);
        Permission::create(['name'=>'admin.roles.store'])->syncRoles([$role3]);
        Permission::create(['name'=>'admin.roles.edit'])->syncRoles([$role3]);
        Permission::create(['name'=>'admin.roles.destroy'])->syncRoles([$role3]);
        Permission::create(['name'=>'admin.permissions.index'])->syncRoles([$role3]);
        Permission::create(['name'=>'admin.permissions.store'])->syncRoles([$role3]);
        Permission::create(['name'=>'admin.permissions.edit'])->syncRoles([$role3]);
        Permission::create(['name'=>'admin.permissions.destroy'])->syncRoles([$role3]);
        Permission::create(['name'=>'admin.raffles.destroy'])->syncRoles([$role3]);
        Permission::create(['name'=>'admin.purchases.allpurchases'])->syncRoles([$role3]);
        Permission::create(['name'=>'admin.purchases.edit'])->syncRoles([$role3]);
        Permission::create(['name'=>'admin.purchases.destroy'])->syncRoles([$role3]);

    }
}
