<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserCreateRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserServices
{

    

    public function __construct(){}

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
        
        return redirect()->route('user.index', 'users')->with('success', 'Usuario actualizado con Exito.');
    }

    public function destroyServices(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return view('viewtemplate.notFound')->with('error', 'Usuario no encontrado.');
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

        $message = $action == 'Eliminacion' ? 'Usuario Eliminado Exitosamente.' : 'Usuario Restaurado Exitosamente.';
        return back()->with('success', $message);
    }

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
        
        return redirect()->route('raffle.index')->with('success', 'Registro completado con Exito.');
    }
}
