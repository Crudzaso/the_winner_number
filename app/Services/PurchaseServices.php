<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Raffle;
use App\Http\Requests\PurchaseRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PurchaseServices
{
    
    public function __construct(){}

    public function indexServices()
    {
        $user = Auth::user();
        $purchases = Purchase::with(['user', 'raffle']);

        if($user->getRoleNames()->first() != 'admin') {
            $purchases->where('user_id', Auth::id());
            $user = Auth::user();
        }

        $purchases = $purchases->paginate(10);
        return view('viewtemplate.purchases', compact('purchases', 'user'));
    }

    public function createServices(string $id)
    {
        $raffle = Raffle::find($id);

        if (!$raffle) {
            return route('raffle.index')->with('error', 'Rifa no encontrada.');
        }

        $purchases = Purchase::where('raffle_id', $raffle->id)->pluck('number')->toArray();  

        return view('viewtemplate.purchaseCreate', compact('raffle', 'purchases'));
    }

    public function storeServices(PurchaseRequest $request)
    {
        $raffle = Raffle::find($request->raffle_id);
        if (!$raffle) {
            return route('raffle.index')->with('error', 'Rifa no encontrada.');
        }

        $user = Auth::user();

        $purchase = Purchase::create([
            'user_id' => $user->id,
            'raffle_id' => (int) $raffle->id,
            'number' => $request->number,
        ]);

        $user->increment('total_spent', $raffle->price);

        return redirect()->route('raffle.index')->with('success', 'Compra Realizada');
    }

    public function showServices(string $id)
    {
        $purchase = Purchase::with('user', 'raffle')->find($id);
        if (!$purchase) {
            return route('raffle.index')->with('error', 'compra no encontrada.');
        }
        return view('viewtemplate.purchaseShow', compact('purchase'));
    }

    public function salesServices()
    {
        $user = Auth::user();

        if(!$user->hasRole('organizer')) {
            return redirect()->back()->with('error', 'Esta pagina no esta diponible para ti.');
        }

        $raffles = Raffle::with('purchases', 'user')->where('user_id', $user->id)->paginate(10);

        return view('viewtemplate.allMySales', compact('raffles'));
    }
}
