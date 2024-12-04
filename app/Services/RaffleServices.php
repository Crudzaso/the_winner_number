<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Raffle;
use App\Http\Requests\RaffleRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;


class RaffleServices
{
    public function __construct(){}

    public function indexServices()
    {
        $user = Auth::user();        
        $raffles = Raffle::with('user')->where('user_id', '!=', $user->id);

        if($user->getRoleNames()->first() != 'admin') {
            $raffles->where('status',true);
        }

        $raffles = $raffles->orderBy('closing_date', 'asc')->paginate(10);
        
        return view('viewtemplate.raffles', compact('raffles'));

    }

    public function myindexServices()
    {
        $user = Auth::user();        

        if($user->getRoleNames()->first() == 'organizer') {
            $raffles = Raffle::with('user')->where('user_id', $user->id )->where('status', true)->orderBy('closing_date', 'asc')->paginate(10);
        }else {
            return redirect()->back()->with('error', 'Esta ruta no esta disponible para ti.');
        }
        
        return view('viewtemplate.raffles', compact('raffles'));

    }

    public function createServices()
    {
        return route('raffle.store');
    }

    public function storeServices(RaffleRequest $request)
    {
        $user = Auth::user();
        $raffle = Raffle::create([
            'name' => $request->name,
            'price' => $request->price,
            'award' => $request->award,
            'start_date' => Carbon::now()->format('Y-m-d'),
            'closing_date' => $request->closing_date,
            'user_id' => $user->id,
        ]);
        $user->increment('raffles_created_count');
        return redirect()->route('raffle.index')->with('success', 'Rifa creada exitosamente.');
    }

    public function showServices(string $id)
    {
        $raffle = Raffle::with('user')->find($id);
        return view('viewtemplate.raffleShow', compact('raffle'));
    }

    public function editServices(string $id)
    {
        $user = Auth::user();
        $raffle = Raffle::with('purchases')->find($id);

        if($user->getRoleNames()->first() == 'admin'){
            return view('viewtemplate.raffleCreate', compact('raffle'));
        }else if($user->getRoleNames()->first() == 'organizer'){           
            if ($raffle->purchases->isEmpty()) {
                return view('viewtemplate.raffleCreate', compact('raffle'));
            }else{
                return back()->with('error', 'Esta Rifa no puede ser editada.');
            }
        }else {
            return back()->with('error', 'Esta pagina no esta disponible para ti.');
        }
    }

    public function updateServices(RaffleRequest $request, string $id)
    {
        $raffle = Raffle::with('purchases', 'user')->find($id);

        if (!$raffle) {
            return view('viewtemplate.notFound')->with('error', 'Rifa no encontrada.');
        }
        if($raffle->user->id != Auth::user()->id){
            return back()->with('error', 'Estas autorizado para para Modificar esta rifa.');
        }
        if($user->getRoleNames()->first() == 'organizer' && !$raffle->purchases->isEmpty()){
            return back()->with('error', 'Esta Rifa no puede ser editada.');
        }
        $raffle->update($request->all());
        return redirect()->route('raffle.index')->with('success', 'Rifa actualizada exitosamente.');
    }

    public function destroyServices(string $id)
    {
        $user = Auth::user();
        $raffle = Raffle::with('user', 'purchases')->find($id);
        if (!$raffle) {
            return view('viewtemplate.notFound')->with('error', 'Rifa no encontrada.');
        }
        if($raffle->user->id != Auth::user()->id){
            return back()->with('error', 'No estas autorizado para para Eliminar esta rifa.');
        }
        if(!$raffle->purchases->isEmpty()) 
        {
            return back()->with('error', 'No se puede eliminar la rifa, ya que hay compras realizadas.');
        }
        $raffle->update([
            'status' => false
        ]);
        $user->decrement('raffles_created_count');
        
        return back()->with('success', 'Rifa eliminada exitosamente.');
    }
}
