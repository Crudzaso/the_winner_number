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
        $participantRole = participantRole::create(['name'=>'participant']);
        $organizerRole = participantRole::create(['name'=>'organizer']);
        $adminRole = participantRole::create(['name'=>'admin']);

        Permission::create(['name'=>'raffles.index'])->syncparticipantRoles([$participantRole, $organizerRole, $adminRole]);
        Permission::create(['name'=>'raffles.show'])->syncparticipantRoles([$participantRole, $organizerRole, $adminRole]);
        Permission::create(['name'=>'purchases.index'])->syncparticipantRoles([$participantRole, $organizerRole,$adminRole]);
        Permission::create(['name'=>'purchases.store'])->syncparticipantRoles([$participantRole, $organizerRole]);
        Permission::create(['name'=>'purchases.show'])->syncparticipantRoles([$participantRole, $organizerRole, $adminRole]);

        Permission::create(['name'=>'raffles.myindex'])->syncparticipantRoles([$organizerRole]);
        Permission::create(['name'=>'raffles.store'])->syncparticipantRoles([$organizerRole]);
        Permission::create(['name'=>'raffles.edit'])->syncparticipantRoles([$organizerRole, $adminRole]);
        Permission::create(['name'=>'raffles.destroy'])->syncparticipantRoles([$organizerRole, $adminRole]);
        Permission::create(['name'=>'purchases.sales'])->syncparticipantRoles([$organizerRole]);

        Permission::create(['name'=>'admin.users.index'])->syncparticipantRoles([$adminRole]);
        Permission::create(['name'=>'admin.users.store'])->syncparticipantRoles([$adminRole]);
        Permission::create(['name'=>'admin.users.edit'])->syncparticipantRoles([$adminRole]);
        Permission::create(['name'=>'admin.users.destroy'])->syncparticipantRoles([$adminRole]);
        Permission::create(['name'=>'admin.participantRoles.index'])->syncparticipantRoles([$adminRole]);
        Permission::create(['name'=>'admin.participantRoles.store'])->syncparticipantRoles([$adminRole]);
        Permission::create(['name'=>'admin.participantRoles.edit'])->syncparticipantRoles([$adminRole]);
        Permission::create(['name'=>'admin.participantRoles.destroy'])->syncparticipantRoles([$adminRole]);
        Permission::create(['name'=>'admin.permissions.index'])->syncparticipantRoles([$adminRole]);
        Permission::create(['name'=>'admin.permissions.store'])->syncparticipantRoles([$adminRole]);
        Permission::create(['name'=>'admin.permissions.edit'])->syncparticipantRoles([$adminRole]);
        Permission::create(['name'=>'admin.permissions.destroy'])->syncparticipantRoles([$adminRole]);
        Permission::create(['name'=>'admin.raffles.destroy'])->syncparticipantRoles([$adminRole]);
        Permission::create(['name'=>'admin.purchases.allpurchases'])->syncparticipantRoles([$adminRole]);
        Permission::create(['name'=>'admin.purchases.edit'])->syncparticipantRoles([$adminRole]);
        Permission::create(['name'=>'admin.purchases.destroy'])->syncparticipantRoles([$adminRole]);

    }
}
