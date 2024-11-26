<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Raffle;
use App\Http\Requests\RaffleRequest;
use App\Services\DiscordServices;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RaffleServices
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
        $raffles = Raffle::with('user');

        if($user->getRoleNames()->first() != 'admin') {
            $raffles->where('status',true);
        }

        $raffles = $raffles->paginate(10);
        
        return view('viewtemplate.raffles', compact('raffles'));

    }

    public function myindexServices()
    {
        $user = Auth::user();        

        if($user->getRoleNames()->first() == 'organizer') {
            $raffles = Raffle::where('user', $user->id )->paginate(10);
        }else {
            return redirect()->back()->with('error', 'Esta ruta no esta disponible para ti.');
        }
        
        return view('viewtemplate.raffles', compact('raffles'));

    }

    public function createServices()
    {
        return view('viewtemplate.raffleCreate');
    }

    public function storeServices(RaffleRequest $request)
    {
        $user = Auth::user();
        $raffle = new Raffle($request->all());
        $raffle->user_id = $user->id;
        $raffle->save();
        $user->increment('raffles_created_count');

        // Mensaje de Discord
        $this->discordServices->discordNotification(
            // Información para el mensaje de notificación
            "Notificación de Raffle",
            "Creaciación de Rifa",
            "Controller Store",
            $user->id,
            $user->name,
            $user->email,
            $user->getRoleNames()->first(),
            "🎉 El usuario ha Creado la rifa \n ID: ".$raffle->id."\n Name: ".$raffle->name."\n costo: ".$raffle->price."\n premio: ".$raffle->award
        );
        return redirect()->route('raffle.index')->with('success', 'Raffle created successfully.');
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
        $user = Auth::user();
        $raffle = Raffle::with('purchases')->find($id);

        if ($user->hasRole('participant')) {
            $user->syncRoles(['organizer']);
        }
        
        if($user->getRoleNames()->first() == 'organizer' && !$raffle->purchases->isEmpty()){
            return back()->with('error', 'Esta Rifa no puede ser editada.');
        }
        if (!$raffle) {
            return view('viewtemplate.notFound')->with('error', 'Rifa no encontrado.');
        }
        $raffle->update($request->all());
        // Mensaje de Discord
        $user = Auth::user();
        $this->discordServices->discordNotification(
            // Información para el mensaje de notificación
            "Notificación de Raffle",
            "Actualización de Rifa",
            "Controller Update",
            $user->id,
            $user->name,
            $user->email,
            $user->getRoleNames()->first(),
            "🎉 El usuario ha Actualizado la rifa \n ID: ".$raffle->id."\n Name: ".$raffle->name."\n costo: ".$raffle->price."\n premio: ".$raffle->award
        );
        return redirect()->route('raffle.index')->with('success', 'Raffle updated successfully.');
    }

    public function destroyServices(string $id)
    {
        $raffle = Raffle::with('user', 'purchases')->find($id);
        if (!$raffle) {
            return view('viewtemplate.notFound')->with('error', 'Rifa no encontrado.');
        }
        if(!$raffle->purchases->isEmpty()) 
        {
            return back()->with('error', 'No se puede eliminar la rifa, ya que hay compras realizadas.');
        }
        $raffle->update([
            'status' => false
        ]);
        // Mensaje de Discord
        $user = Auth::user();
        $this->discordServices->discordNotification(
            // Información para el mensaje de notificación
            "Notificación de Raffle",
            "Eliminacion de Rifa",
            "Controller Destroy",
            $user->id,
            $user->name,
            $user->email,
            $user->getRoleNames()->first(),
            "🎉 El usuario ha Eliminado la rifa \n ID: ".$raffle->id."\n Name: ".$raffle->name."\n costo: ".$raffle->price."\n premio: ".$raffle->award
        );
        return back()->with('success', 'Raffle deleted successfully.');
    }
}
