<?php

namespace App\Services;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Services\ErrorServices;
use App\Http\Requests\RoleRequest;
use App\Http\Requests\RoleUpdateRequest;

class RoleServices
{
    private DiscordServices $discordServices;

    public function __construct(
        DiscordServices $discordServices
    )
    {
        $this->discordServices = $discordServices;
    }

    /**
     * Display a listing of the resource.
     */
    public function indexServices()
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('viewtemplate.roles', compact('roles', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createServices()
    {
        $permissions = Permission::all();

        return view('viewtemplate.roleCreate', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeServices(RoleRequest $request)
    {

        $role = Role::create(['name' => $request->name]);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('roles.index')->with('success', 'Rol creado con éxito.');
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editServices(string $id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return view('viewtemplate.roleEdit', compact('role', 'permissions', 'rolePermissions'));
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateServices(RoleUpdateRequest $request, string $id)
    {

        $role = Role::findOrFail($id);
        $role->update(['name' => $request->name]);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('roles.index')->with('success', 'Rol actualizado con éxito.');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyServices(string $id)
    {
        $role = Role::find($id);

        if ($role) {
            $role->delete();
            return redirect()->route('roles.index')->with('success', 'Rol eliminado con éxito.');
        } else {
            return "El rol '{$role->name}' no existe.";
        }
    }

    public function revokeRoleServices(string $id, string $role)
    {
        $user = User::find($id);
        $user->removeRole($role);
        return redirect()->route('roles.index')->with('success', 'Rol eliminado con éxito.');
    }

    public function assignRoleServices(string $id, string $role)
    {
        $user = User::find($id);
        $user->assignRole($role);
        return redirect()->route('roles.index')->with('success', 'Rol asignado con éxito.');
    }

}
