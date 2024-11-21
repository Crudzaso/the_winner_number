<?php

namespace App\Services;

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

        return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
    }

    public function editServices(Permission $permission)
    {
        return view('viewtemplate.permissionsEdit', compact('permission'));
    }

    public function updateServices(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id . '|max:255',
        ]);

        $permission->update(['name' => $request->name]);

        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');
    }

    public function destroyServices(role $role, Permission $permission)
    {
        $role->revokePermissionTo($permission);
        return redirect()->back()->with('success', 'Permission deleted successfully.');
    }
}
