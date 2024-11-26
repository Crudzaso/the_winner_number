<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserCreateRequest;
use App\Services\DiscordServices;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserServices
{

    private DiscordServices $discordServices;

    public function __construct(
        DiscordServices $discordServices
    )
    {
        $this->discordServices = $discordServices;
    }

    public function indexServices(string $status)
    {
        $query = User::with('roles');

        if ($status === 'activos') {
            $query->where('status', true);
        } elseif ($status === 'inactivos') {
            $query->where('status', false);
        }

        $users = $query->paginate(10);

        return view('viewtemplate.users', compact('users'));
    }


    public function createServices()
    {
        $roles = Role::all();
        return view('viewtemplate.userCreate', compact('roles'));
    }

    public function storeServices(UserCreateRequest $request)
    {
        $user = new User($request->all());
        $user->save();
        $user->assignRole($request->role);
        // Mensaje de Discord
        $admin = Auth::user();
        $this->discordServices->discordNotification(
            // Información para el mensaje de notificación
            "Notificación de User",
            "Creaciación de Usuario",
            "Controller Store",
            $admin->id,
            $admin->name,
            $admin->email,
            "🎉 El usuario ha Creado un nuevo usuario \n ID: ".$user->id."\n Name: ".$user->name."\n email: ".$user->email."\n rol: ".$request->role
        );
        return redirect()->route('user.index', 'users')->with('success', 'Raffle created successfully.');
    }

    public function showServices(string $id)
    {
        $user = User::with(['roles', 'raffles', 'purchases'])->find($id);
        return view('viewtemplate.usershow', compact('user'));
    }

    public function editServices(string $id)
    {
        $user = User::with('roles')->find($id);
        $roles = Role::all();
        return view('viewtemplate.userEdit', compact('user', 'roles'));
    }

    public function updateServices(UserUpdateRequest $request,string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return view('viewtemplate.notFound')->with('error', 'Usuario no encontrado.');
        }
        $user->update($request->validated());
        $user->assignRole($request->role);
        // Mensaje de Discord
        $admin = Auth::user();
        $this->discordServices->discordNotification(
            // Información para el mensaje de notificación
            "Notificación de User",
            "Actualización de Usuario",
            "Controller Update",
            $admin->id,
            $admin->name,
            $admin->email,
            "🎉 El administrador ha Actualizado al usuario: \n ID: ".$user->id."\n Name: ".$user->name."\n correo: ".$user->email
        ); 
        return redirect()->route('user.index', 'users')->with('success', 'Usuario actualizado con Exito.');
    }

    public function destroyServices(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return view('viewtemplate.notFound')->with('error', 'Rifa no encontrado.');
        }
        if($user->status == true)
        {
            $action = 'Eliminacion';
            $user->update([
                'status' => false,
            ]);
        }
        else
        {
            $action = 'Reactivacion';
            $user->update([
                'status' => true,
            ]);            
        }

        $admin = Auth::user();
        // Mensaje de Discord
        $this->discordServices->discordNotification(
            // Información para el mensaje de notificación
            "Notificación de Usuario",
            $action." de usuario",
            "Controller Destroy",
            "Admin Id: ".$user->id,
            "Nombre: ". $user->name,
            "Correo: ". $user->email,
            "🎉 El usuario ha Eliminado ha \n ID: ".$user->id."\n Name: ".$user->name."\n email: ".$user->email."\n estado: Eliminado"
        );
        $message = $action == 'Eliminacion' ? 'Usuario Eliminado Exitosamente.' : 'Usuario Restaurado Exitosamente.';
        return back()->with('success', $message);
    }
    //redirect()->route('user.index', 'users')

    public function formInformationUserServices()
    {
        $user = Auth::user();
        return view('viewtemplate.formInformationRequiredUser', compact('user'));
    }

    public function completeRegistrationServices(UserRequest $request)
    {
        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'date_of_birth' => $request->date_of_birth,
            'identification_number' => $request->identification_number,
            'agreement_terms' => $request->agreement_terms,
            'accepted_privacy_policy' => $request->accepted_privacy_policy,
            'nequi_account' => $request->nequi_account,
            'date_of_birth' => $request->date_of_birth,
            'status' => true
        ]);
        // Mensaje de Discord
        $user = Auth::user();
        $this->discordServices->discordNotification(
            // Información para el mensaje de notificación
            "Notificación de user",
            "Registro compreto",
            "Controller CompleteRegistration",
            $user->id,
            $user->name,
            $user->email,
            "🎉 El usuario ".$user->name." ha Completado su registro registro."
        );
        return redirect()->route('raffle.index')->with('success', 'Registro completado con Exito.');
    }
}
