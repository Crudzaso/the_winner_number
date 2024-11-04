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

            // Información para el mensaje de notificación
            $companyName = " The Winner Number ";
            $logoUrl = 'https://private-user-images.githubusercontent.com/116232866/382150624-2fb0a0cf-722c-4f79-8310-36d7b295ac61.png?jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJnaXRodWIuY29tIiwiYXVkIjoicmF3LmdpdGh1YnVzZXJjb250ZW50LmNvbSIsImtleSI6ImtleTUiLCJleHAiOjE3MzA3NTcyNDQsIm5iZiI6MTczMDc1Njk0NCwicGF0aCI6Ii8xMTYyMzI4NjYvMzgyMTUwNjI0LTJmYjBhMGNmLTcyMmMtNGY3OS04MzEwLTM2ZDdiMjk1YWM2MS5wbmc_WC1BbXotQWxnb3JpdGhtPUFXUzQtSE1BQy1TSEEyNTYmWC1BbXotQ3JlZGVudGlhbD1BS0lBVkNPRFlMU0E1M1BRSzRaQSUyRjIwMjQxMTA0JTJGdXMtZWFzdC0xJTJGczMlMkZhd3M0X3JlcXVlc3QmWC1BbXotRGF0ZT0yMDI0MTEwNFQyMTQ5MDRaJlgtQW16LUV4cGlyZXM9MzAwJlgtQW16LVNpZ25hdHVyZT01MjRhN2E1OGMxYTBiOWJmZGIzM2U0YjY4NmZhYzcwNjQyNzM1ZmU4ZTQzN2VjZDIzNDdiNGM1MjA5ZTA3MTVkJlgtQW16LVNpZ25lZEhlYWRlcnM9aG9zdCJ9.G_OFBF5TidqPnesPMYmZTjXbp7behpFnhABy9EHXUgo';
            $authMethod = "Google";
            $userId =  $user->id;
            $userName = $user->name;
            $userEmail = $user->email;
            $date = now()->format('Y-m-d H:i:s');
            $notificationMessage = "🎉 El usuario ha iniciado sesión correctamente.";

            // Mensaje de Discord
            $this->sendDiscordNotification(
                $companyName,
                $logoUrl,
                $authMethod,
                $userId,
                $userName,
                $userEmail,
                $date,
                $notificationMessage
            );

            return redirect()->intended('/dashboard');
        } catch (Exception $e) {
            return redirect('/login')->withErrors(['error' => '⚠️ Error en la autenticación de Google.']);
        }
    }

    public function sendDiscordNotification($companyName, $logoUrl, $authMethod, $userId, $userName, $userEmail, $date, $notificationMessage)
    {
        $message = [
            'embeds' => [
                [
                    'title' => "🔔 Notificación de Inicio de Sesión",
                    'color' => 7506394,
                    'thumbnail' => [
                        'url' =>  $logoUrl

                    ],
                    'fields' => [
                        [
                            'name' => "Equipo",
                            'value' => "🏆" . $companyName . "🏆",
                            'inline' => true,
                        ],
                        [
                            'name' => "🔒 Método de Autenticación",
                            'value' => "🔑 " . $authMethod,
                            'inline' => true,
                        ],
                        [
                            'name' => "ID del Usuario",
                            'value' => "🆔 " . $userId,
                            'inline' => true,
                        ],
                        [
                            'name' => "👤 Nombre del Usuario",
                            'value' => $userName,
                            'inline' => true,
                        ],
                        [
                            'name' => "📧 Correo Electrónico",
                            'value' => $userEmail,
                            'inline' => true,
                        ],
                        [
                            'name' => "📅 Fecha",
                            'value' => $date,
                            'inline' => true,
                        ],
                        [
                            'name' => "💬 Mensaje",
                            'value' => $notificationMessage,
                            'inline' => false,
                        ],
                    ],
                ],
            ],
        ];

        $webhookUrl = "https://discord.com/api/webhooks/1301003658829369364/5GrGrrjS24dWsQZj03YFOnE5LE1duNNcTFTX4Y71rcTS4rV2a_TGYqRbJSWALX-yny6J";

        if ($webhookUrl) {
            $response = Http::post($webhookUrl, $message);

            if ($response->failed()) {
                \Log::error('Error al enviar la notificación a Discord:', [
                    'response' => $response->body(),
                    'status' => $response->status(),
                ]);
            } else {
                \Log::info('Notificación enviada a Discord con éxito.');
            }
        } else {
            \Log::error('Discord webhook URL no está configurada en el archivo .env');
        }
    }
}
