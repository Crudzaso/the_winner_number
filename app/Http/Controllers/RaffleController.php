<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Raffle;
use App\Http\Requests\RaffleRequest;
use App\Services\RaffleServices;
use App\Services\ErrorServices;

class RaffleController extends Controller
{
    private RaffleServices $raffleServices;
    private ErrorServices $errorServices;

    public function __construct(
        RaffleServices $raffleServices,
        ErrorServices $errorServices
    )
    {
        $this->raffleServices = $raffleServices;
        $this->errorServices = $errorServices;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return  $this->errorServices->handleError(function(){return $this->raffleServices->indexServices();});
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return  $this->errorServices->handleError(function(){return $this->raffleServices->createServices();});
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RaffleRequest $request)
    {
        return  $this->errorServices->handleError(function()use($request){return $this->raffleServices->storeServices($request);});        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return  $this->errorServices->handleError(function()use($id){return $this->raffleServices->showServices($id);});
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return  $this->errorServices->handleError(function()use($id){return $this->raffleServices->editServices($id);});
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RaffleRequest $request, string $id)
    {
        return  $this->errorServices->handleError(function()use($request, $id){return $this->raffleServices->updateServices($request, $id);});
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return  $this->errorServices->handleError(function()use($id){return $this->raffleServices->destroyServices($id);});
    }
}
