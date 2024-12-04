<?php

namespace App\Services;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsServices
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function indexServices()
    {
        $permissions = Permission::all();
        return view('viewtemplate.permissions', compact('permissions'));
    }

    public function createServices()
    {
        return view('viewtemplate.permissionsCreate');
    }

    public function storeServices(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name|max:255',
        ]);

        Permission::create(['name' => $request->name]);

        return redirect()->route('permissions.index')->with('success', 'Permiso creado exitosamentefwa<.');
    }

    public function editServices(Permission $permission)
    {
        if (!$permission) {
            return redirect()->route('permissions.index')->with('error', 'Permiso no encontrado.');
        }
        return view('viewtemplate.permissionsEdit', compact('permission'));
    }

    public function updateServices(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id . '|max:255',
        ]);

        $permission->update(['name' => $request->name]);

        return redirect()->route('permissions.index')->with('success', 'Permiso actualizado exitosamente.');
    }

    public function destroyServices(Permission $permission)
    {
        $permission->delete();
        return redirect()->back()->with('success', 'Permiso eliminado exitosamente.');
    }

    public function revokePermissionServices(string $model, string $id, Permission $permission)
    {
        
        if (!$permission) {
            return redirect()->back()->with('error', 'Permiso no encontrado.');
        }
        if($model == 'user'){
            $user = User::find($id);
            if (!$user)        {
                return redirect()->back()->with('error', 'Usuario no encontrado.');
            }
            $user->revokePermissionTo($permission->name);
        } else  if ($model == 'role') {
            $role = Role::find($id);
            if (!$role)        {
                return redirect()->back()->with('error', 'Rol no encontrado.');
            }
            $role->revokePermissionTo($permission->name);
        } else {
            return redirect()->back()->with('error', 'Modelo de entidad no válido.');
        }
        return redirect()->back()->with('success', 'Permiso eliminado exitosamente.');
    }
    
    public function assignPermissionServices(string $model, string $id, Permission $permission)
    {
        if (!$permission) {
            return redirect()->back()->with('error', 'Permiso no encontrado.');
        }
        if($model == 'user'){
            $user = User::find($id);
            if (!$user)        {
                return redirect()->back()->with('error', 'Usuario no encontrado.');
            }
            $user->givePermissionTo($permission->name);
        } else  if ($model == 'role') {
            $role = Role::find($id);
            if (!$role)        {
                return redirect()->back()->with('error', 'Rol no encontrado.');
            }
            $role->givePermissionTo($permission->name);
        } else {
            return redirect()->back()->with('error', 'Modelo de entidad no válido.');
        }
        return redirect()->back()->with('success', 'Permiso asignado exitosamente.');
    }

}
