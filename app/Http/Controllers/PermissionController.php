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
        $this->purchaseServices = $purchaseServices;
        $this->errorServices = $errorServices;
    }

    public function index()
    {
        return $this->errorServices->handleError(function(){return $this->permissionsServices->indexServices();});
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        return $this->errorServices->handleError(function()use($id){return $this->permissionsServices->createServices($id);});

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PurchaseRequest $request)
    {
        return $this->errorServices->handleError(function()use($request){return $this->permissionsServices->storeServices($request);});
    }

    public function edit()
    {
        return $this->errorServices->handleError(function(){return $this->permissionsServices->editServices();});
    }

    public function update()
    {
        return $this->errorServices->handleError(function(){return $this->permissionsServices->updateServices();});
    }
    
    public function destroy(Role $role, Permission $permission)
    {
        return $this->errorServices->handleError(function()use($role, $permission){return $this->permissionsServices->destroyServices($role, $permission);});
    }
}
