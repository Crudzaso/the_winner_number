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
            $googleUser = Socialite::driver('google')->stateless()->user();
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt('random_password')
                ]);
            }

            Auth::login($user);

            // Enviar notificación a Discord
            $this->sendDiscordNotification("Usuario {$user->name} ha iniciado sesión con Google.");

            return redirect()->intended('/dashboard');
        } catch (Exception $e) {
            return redirect('/login')->withErrors(['error' => 'Error en la autenticación de Google.']);
        }
    }

    /**
     * Envía un mensaje a un webhook de Discord.
     *
     * @param string $message
     * @return void
     */
    public function sendDiscordNotification($message)
    {
        $webhookUrl = 'https://discord.com/api/webhooks/1301003658829369364/5GrGrrjS24dWsQZj03YFOnE5LE1duNNcTFTX4Y71rcTS4rV2a_TGYqRbJSWALX-yny6J';

        $payload = [
            'content' => $message,
        ];

        // Enviar solicitud HTTP POST al webhook de Discord
        try {
            $client = new \GuzzleHttp\Client();
            $client->post($webhookUrl, [
                'json' => $payload,
            ]);
        } catch (Exception $e) {
            // Manejo de errores
            \Log::error('Error al enviar mensaje a Discord: ' . $e->getMessage());
        }
    }

}
