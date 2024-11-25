<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use App\Services\DiscordServices;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class AuthenticatedSessionController extends Controller
{

    private DiscordServices $discordServices;

    public function __construct(
        DiscordServices $discordServices
    )
    {
        $this->discordServices = $discordServices;
    }

    /**
     * Redirige al usuario a la página de autenticación de Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->with(["prompt" => "select_account"])->redirect();
    }

    /**
     * Maneja la respuesta de Google después de la autenticación.
     *
     * @return \Illuminate\Http\Response
     */
        public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = User::updateOrCreate([
                'google_id' => $googleUser->id,
            ],[
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
            ]);

            if ($user->getRoleNames()->isEmpty()) {
                $user->assignRole('participant');
            }
            
            if ($user->status == false) {
                return redirect('/login')->withErrors('error', '⚠️ El usuario ha sido desactivado. Por favor contacte al administrador.');
            }
            

            Auth::login($user);

            // Mensaje de Discord
            $this->discordServices->discordNotification(
                // Información para el mensaje de notificación
                "Notificación de Inicio de Sesión",
                "Método de Autenticación",
                "Google",
                $user->id,
                $user->name,
                $user->email,
                "🎉 El usuario ha iniciado sesión correctamente."
            );

            if ($this->verifyUser()) { 
                return redirect()->route('user.forminformationuser');
            }

            return redirect()->route('raffle.index')->with('success', 'Registro completado con Exito.');

        } catch (Exception $e) {
            Log::error('Error en la autenticacion: ', ['message' => $e->getMessage()]);
            // Mensaje de Discord
            $this->discordServices->discordErrorNotification(
                'Error de uatenticacion',
                $e->getMessage(),
                $e->getCode(),
                $e->getFile(),
                $e->getLine()
            );
            return redirect('/login')->withErrors(['error' => '⚠️ Error en la autenticación de Google.']);
        }
    }

    public function verifyUser()
    {
        $user = Auth::user();
        return empty($user->identification_number) || !$user->agreement_terms || !$user->accepted_privacy_policy;
    }
    
}
