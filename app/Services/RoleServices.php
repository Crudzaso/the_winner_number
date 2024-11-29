<?php

namespace App\Services;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Services\ErrorServices;
use App\Http\Requests\RoleRequest;

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
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array',
        ]);

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
    public function updateServices(RoleRequest $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
            'permissions' => 'array',
        ]);

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
            $usersWithRole = User::role($role->name)->get();

            foreach ($usersWithRole as $user) {
                $user->removeRole($roleName);
            }

            return "El rol '{$roleName}' fue removido de todos los usuarios que lo tenían.";
        } else {
            return "El rol '{$roleName}' no existe.";
        }

        return redirect()->route('roles.index')->with('success', 'Rol eliminado con éxito.');
    }

    /*public function RevokeServices(string $id, string $role)
    {
        $user = User::find($id);
        $user->removeRole($role);
        return redirect()->route('roles.index')->with('success', 'Rol eliminado con éxito.');
    }*/

}
