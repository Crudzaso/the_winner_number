<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class AuthenticatedSessionController extends Controller
{

    /**
     * Redirige al usuario a la página de autenticación de Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Maneja la respuesta de Google después de la autenticación.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback()
    {
        try {
            // Obtener el usuario autenticado desde Google
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Buscar el usuario en la base de datos
            $user = User::where('email', $googleUser->getEmail())->first();

            // Si el usuario no existe, crear un nuevo usuario
            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt('random_password')  // Se requiere un password pero no se usará
                ]);
            }

            // Iniciar sesión al usuario
            Auth::login($user);

            // Redirigir al usuario a la página de inicio u otra página deseada
            return redirect()->intended('/dashboard');
        } catch (Exception $e) {
            // Manejo de errores
            return redirect('/login')->withErrors(['error' => 'Error en la autenticación de Google.']);
        }
    }


    //
}
