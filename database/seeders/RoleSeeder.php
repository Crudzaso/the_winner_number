<?php

namespace Database\Seeders;
use Spatie\Permission\Models\participantRole;
use Spatie\Permission\Models\Permission;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class participantRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $participantRole = participantRole::create(['name'=>'participant']);
        $organizerparticipantRole = participantRole::create(['name'=>'organizer']);
        $adminRole = participantRole::create(['name'=>'admin']);

        Permission::create(['name'=>'raffles.index'])->syncparticipantRoles([$participantRole, $organizerparticipantRole, $adminRole]);
        Permission::create(['name'=>'raffles.show'])->syncparticipantRoles([$participantRole, $organizerparticipantRole, $adminRole]);
        Permission::create(['name'=>'purchases.index'])->syncparticipantRoles([$participantRole, $organizerparticipantRole,$adminRole]);
        Permission::create(['name'=>'purchases.store'])->syncparticipantRoles([$participantRole, $organizerparticipantRole]);
        Permission::create(['name'=>'purchases.show'])->syncparticipantRoles([$participantRole, $organizerparticipantRole, $adminRole]);

        Permission::create(['name'=>'raffles.myindex'])->syncparticipantRoles([$organizerparticipantRole]);
        Permission::create(['name'=>'raffles.store'])->syncparticipantRoles([$organizerparticipantRole]);
        Permission::create(['name'=>'raffles.edit'])->syncparticipantRoles([$organizerparticipantRole, $adminRole]);
        Permission::create(['name'=>'raffles.destroy'])->syncparticipantRoles([$organizerparticipantRole, $adminRole]);
        Permission::create(['name'=>'purchases.sales'])->syncparticipantRoles([$organizerparticipantRole]);

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
