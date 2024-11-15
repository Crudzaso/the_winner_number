<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserCreateRequest;
use App\Services\UserServices;
use App\Services\ErrorServices;
use App\Models\User;

class UserController extends Controller
{
    private UserServices $userServices;
    private ErrorServices $errorServices;

    public function __construct(
        UserServices $userServices,
        ErrorServices $errorServices
    )
    {
        $this->userServices = $userServices;
        $this->errorServices = $errorServices;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(string $status)
    {
        return  $this->errorServices->handleError(function()use($status){return $this->userServices->indexServices($status);});
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return  $this->errorServices->handleError(function(){return $this->userServices->createServices();});
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserCreateRequest $request)
    {
        return  $this->errorServices->handleError(function()use($request){return $this->userServices->storeServices($request);});        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return  $this->errorServices->handleError(function()use($id){return $this->userServices->showServices($id);});
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return  $this->errorServices->handleError(function()use($id){return $this->userServices->editServices($id);});
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request,string $id)
    {
        return  $this->errorServices->handleError(function()use($request, $id){return $this->userServices->updateServices($request, $id);});
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return  $this->errorServices->handleError(function()use($id){return $this->userServices->destroyServices($id);});
    }

    public function formInformationUser()
    {
        return  $this->errorServices->handleError(function(){return $this->userServices->formInformationUserServices();});
    }

    public function completeRegistration(UserRequest $request)
    {
        return  $this->errorServices->handleError(function()use($request){return $this->userServices->completeRegistrationServices($request);});
    }
}
