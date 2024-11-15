<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Raffle;
use App\Services\ErrorServices;
use App\Services\PurchaseServices;
use App\Services\RaffleServices;


class PurchaseController extends Controller
{
    private PurchaseServices $purchaseServices;
    private ErrorServices $errorServices;

    public function __construct(
        PurchaseServices $purchaseServices,
        ErrorServices $errorServices
    )
    {
        $this->purchaseServices = $purchaseServices;
        $this->errorServices = $errorServices;
    }

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return $this->errorServices->handleError(function(){return $this->purchaseServices->indexServices();});
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        return $this->errorServices->handleError(function()use($id){return $this->purchaseServices->createServices($id);});

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PurchaseRequest $request)
    {
        return $this->errorServices->handleError(function()use($request){return $this->purchaseServices->storeServices($request);});
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->errorServices->handleError(function()use($id){return $this->purchaseServices->showServices($id);});
    }

    public function sales()
    {
        dd('hola mundo');
        return $this->errorServices->handleError(function(){return $this->purchaseServices->salesServices();});
    }
}
