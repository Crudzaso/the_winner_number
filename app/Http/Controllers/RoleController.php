<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RoleServices;
use App\Services\ErrorServices;

class RoleController extends Controller
{

    private RoleServices $roleServices;
    private ErrorServices $errorServices;

    public function __construct(
        RoleServices $roleServices,
        ErrorServices $errorServices
    )
    {
        $this->roleServices = $roleServices;
        $this->errorServices = $errorServices;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return  $this->errorServices->handleError(function(){return $this->roleServices->indexServices();});
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return  $this->errorServices->handleError(function(){return $this->roleServices->createServices();});
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return  $this->errorServices->handleError(function()use($request){return $this->roleServices->storeServices($request);});        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return  $this->errorServices->handleError(function()use($id){return $this->roleServices->editServices($id);});
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return  $this->errorServices->handleError(function()use($request, $id){return $this->roleServices->updateServices($request, $id);});
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return  $this->errorServices->handleError(function()use($id){return $this->roleServices->destroyServices($id);});
    }

    public function Revoke(string $id, string $role)
    {
        return  $this->errorServices->handleError(function()use($id, $role){return $this->roleServices->revokeServices($id, $role);});
    }
}
