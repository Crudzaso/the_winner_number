<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Raffle;

class RaffleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $raffles = Raffle::where('status',true)->get();
        return view('viewtemplate.raffles', compact('raffles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('viewtemplate.raffleCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $raffle = new Raffle($request->all());
        $raffle->user_id = Auth::id();
        $raffle->save();
        return redirect()->route('raffle.index')->with('success', 'Raffle created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $raffle = Raffle::find($id);
        return view('viewtemplate.raffleShow', compact('raffle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $raffle = Raffle::find($id);
        return view('viewtemplate.raffleCreate', compact('raffle'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $raffle = Raffle::find($id);
        $raffle->update($request->all());
        return redirect()->route('raffle.index')->with('success', 'Raffle updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $raffle = Raffle::find($id);
        $raffle -> status = false;
        $raffle->save();
        return back();
    }
}
