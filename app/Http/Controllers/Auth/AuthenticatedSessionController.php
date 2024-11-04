<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;


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

                // Enviar notificación a Discord con el mensaje personalizado
            $companyName = "Tu Empresa";
            $companyLogo = "storage\app\public\images\project_brand.png";  // Reemplaza con el enlace a tu logo
            $loginMethod = "Google";
            $userId = $user->id;
            $userName = $user->name;
            $userEmail = $user->email;
            $loginDate = Carbon::now()->format('Y-m-d H:i:s');
            $notificationMessage = "El usuario ha iniciado sesión correctamente.";

            $message = "**{$companyName}**\n";
            $message .= "**Logo:** ![Logo]({$companyLogo})\n";
            $message .= "**Método de Inicio de Sesión:** {$loginMethod}\n";
            $message .= "**ID del Usuario:** {$userId}\n";
            $message .= "**Nombre del Usuario:** {$userName}\n";
            $message .= "**Correo Electrónico:** {$userEmail}\n";
            $message .= "**Fecha de Inicio de Sesión:** {$loginDate}\n";
            $message .= "**Mensaje:** {$notificationMessage}";

            // Llamar a sendDiscordNotification con todos los parámetros requeridos
        $this->sendDiscordNotification($companyName, $logoUrl, $authMethod, $userId, $userName, $userEmail, $date, $notificationMessage);


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
        public function sendDiscordNotification($companyName, $logoUrl, $authMethod, $userId, $userName, $userEmail, $date, $notificationMessage)
    {
        $message = [
            'embeds' => [
                [
                    'title' => "Notificación de Inicio de Sesión",
                    'color' => 7506394, // Color del mensaje (puedes cambiarlo)
                    'fields' => [
                        [
                            'name' => "Nombre de la Empresa",
                            'value' => $companyName,
                            'inline' => true,
                        ],
                        [
                            'name' => "Logo",
                            'value' => $logoUrl,
                            'inline' => true,
                        ],
                        [
                            'name' => "Método de Autenticación",
                            'value' => $authMethod,
                            'inline' => true,
                        ],
                        [
                            'name' => "ID del Usuario",
                            'value' => $userId,
                            'inline' => true,
                        ],
                        [
                            'name' => "Nombre del Usuario",
                            'value' => $userName,
                            'inline' => true,
                        ],
                        [
                            'name' => "Correo Electrónico",
                            'value' => $userEmail,
                            'inline' => true,
                        ],
                        [
                            'name' => "Fecha",
                            'value' => $date,
                            'inline' => true,
                        ],
                        [
                            'name' => "Mensaje",
                            'value' => $notificationMessage,
                            'inline' => false,
                        ],
                    ],
                ],
            ],
        ];

        $webhookUrl = 'TU_WEBHOOK_URL_DE_DISCORD';

        // Envía la solicitud al webhook de Discord
        Http::post($webhookUrl, $message);
    }

}
