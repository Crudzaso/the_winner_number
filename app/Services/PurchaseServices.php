<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Raffle;
use App\Http\Requests\PurchaseRequest;
use App\Services\DiscordServices;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PurchaseServices
{
    
    private DiscordServices $discordServices;

    public function __construct(
        DiscordServices $discordServices
    )
    {
        $this->discordServices = $discordServices;
    }

    public function indexServices()
    {
        $user = Auth::user();
        $purchases = Purchase::with(['user', 'raffle']);

        if($user->getRoleNames()->first() != 'admin') {
            $purchases->where('user_id', Auth::id());
        }

        $purchases = $purchases->paginate(10);
        return view('viewtemplate.purchases', compact('purchases'));
    }

    public function createServices(string $id)
    {
        $raffle = Raffle::find($id);

        if (!$raffle) {
            return view('viewtemplate.notFound')->with('error', 'Rifa no encontrado.');
        }

        $purchases = Purchase::where('raffle_id', $raffle->id)->pluck('number')->toArray();  

        return view('viewtemplate.purchaseCreate', compact('raffle', 'purchases'));
    }

    public function storeServices(PurchaseRequest $request)
    {
        $raffle = Raffle::find($request->raffle_id);
        if (!$raffle) {
            return view('viewtemplate.notFound')->with('error', 'Rifa no encontrado.');
        }

        $user = Auth::user();

        $purchase = Purchase::create([
            'user_id' => $user->id,
            'raffle_id' => (int) $raffle->id,
            'number' => $request->number,
        ]);

        $user->increment('total_spent', $raffle->price);
        
        // Mensaje de Discord
        $this->discordServices->discordNotification(
            // Información para el mensaje de notificación
            "Notificación de Purchase",
            "Creaciación de Compra",
            "Controller Store",
            $user->id,
            $user->name,
            $user->email,
            $user->getRoleNames()->first(),
            "🎉 El usuario ha Creado una compra \n ID: ".$purchase->id."\n Rifa: ".$raffle->name."\n Usuario: ".$user->name."\n Number: ".$request->number
        );
        return redirect()->route('raffle.index')->with('success', 'Compra Realizada');
    }

    public function showServices(string $id)
    {
        $purchase = Purchase::with(['user', 'raffle'])->find($id);
        if (!$purchase) {
            return view('viewtemplate.notFound')->with('error', 'compra no encontrada.');
        }
        return view('viewtemplate.purchaseShow', compact('purchase'));
    }

    public function salesServices()
    {
        $user = Auth::user();


        if($user->getRoleNames()->first() != 'organizer') {
            return redirect()->back()->with('error', 'Esta pagina no esta diponible para ti.');
        }

        $raffles = Raffle::with('purchases', 'user')->where('user_id', $user->id)->paginate(10);

        return view('viewtemplate.allMySales', compact('raffles'));
    }
}
