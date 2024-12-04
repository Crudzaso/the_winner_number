<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Services\PermissionsServices;
use App\Services\ErrorServices;
use Spatie\Permission\Models\Role;
Spatie\Permission\Models\Permission::class;

class PermissionController extends Controller
{
    private PermissionsServices $permissionsServices;
    private ErrorServices $errorServices;

    public function __construct(
        PermissionsServices $permissionsServices,
        ErrorServices $errorServices
    )
    {
        $this->permissionsServices = $permissionsServices;
        $this->errorServices = $errorServices;
    }

    public function index()
    {
        return $this->errorServices->handleError(function(){return $this->permissionsServices->indexServices();});
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->errorServices->handleError(function(){return $this->permissionsServices->createServices();});

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PurchaseRequest $request)
    {
        return $this->errorServices->handleError(function()use($request){return $this->permissionsServices->storeServices($request);});
    }

    public function edit(Permission $permission)
    {
        return $this->errorServices->handleError(function()use($permission){return $this->permissionsServices->editServices($permission);});
    }

    public function update()
    {
        return $this->errorServices->handleError(function(){return $this->permissionsServices->updateServices();});
    }
    
    public function destroy(User $user, Permission $permission)
    {
        return $this->errorServices->handleError(function()use($user, $permission){return $this->permissionsServices->destroyServices($user, $permission);});
    }

    public function revokePermission(string $model, string $id, Permission $permission)
    {
        return $this->errorServices->handleError(function()use($model, $id, $permission){return $this->permissionsServices->revokePermissionServices($model, $id, $permission);});
    }

    public function assignPermission(string $model, string $id, Permission $permission)
    {
        return $this->errorServices->handleError(function()use($model, $id, $permission){return $this->permissionsServices->assignPermissionServices($model, $id, $permission);});
    }

}
