<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;


class DiscordServices
{

    public function discordNotification($tittle ,$typeMessage, $authMethod, $userId, $userName, $userEmail, $notificationMessage)
    {
        $message = [
            'embeds' => [
                [
                    'title' => "🔔 ". $tittle,
                    'color' => 7506394,
                    'thumbnail' => [
                        'url' => 'https://private-user-images.githubusercontent.com/116232866/382150624-2fb0a0cf-722c-4f79-8310-36d7b295ac61.png?jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJnaXRodWIuY29tIiwiYXVkIjoicmF3LmdpdGh1YnVzZXJjb250ZW50LmNvbSIsImtleSI6ImtleTUiLCJleHAiOjE3MzA3NTcyNDQsIm5iZiI6MTczMDc1Njk0NCwicGF0aCI6Ii8xMTYyMzI4NjYvMzgyMTUwNjI0LTJmYjBhMGNmLTcyMmMtNGY3OS04MzEwLTM2ZDdiMjk1YWM2MS5wbmc_WC1BbXotQWxnb3JpdGhtPUFXUzQtSE1BQy1TSEEyNTYmWC1BbXotQ3JlZGVudGlhbD1BS0lBVkNPRFlMU0E1M1BRSzRaQSUyRjIwMjQxMTA0JTJGdXMtZWFzdC0xJTJGczMlMkZhd3M0X3JlcXVlc3QmWC1BbXotRGF0ZT0yMDI0MTEwNFQyMTQ5MDRaJlgtQW16LUV4cGlyZXM9MzAwJlgtQW16LVNpZ25hdHVyZT01MjRhN2E1OGMxYTBiOWJmZGIzM2U0YjY4NmZhYzcwNjQyNzM1ZmU4ZTQzN2VjZDIzNDdiNGM1MjA5ZTA3MTVkJlgtQW16LVNpZ25lZEhlYWRlcnM9aG9zdCJ9.G_OFBF5TidqPnesPMYmZTjXbp7behpFnhABy9EHXUgo'


                    ],
                    'fields' => [
                        [
                            'name' => "Equipo",
                            'value' => "🏆" . " The Winner Number " . "🏆",
                            'inline' => true,
                        ],
                        [
                            'name' => "🔒 " . $typeMessage,
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
                            'value' => now()->format('Y-m-d H:i:s'),
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

        $this->sendDiscordMessageNotification($webhookUrl,$message);
    }

    public function discordErrorNotification($tittle, $errorMessage, $code, $file, $line)
    {
        $message = [
            'embeds' => [
                [
                    'title' => "🔔 ".$tittle,
                    'color' => 7506394,
                    'thumbnail' => [
                        'url' => 'https://private-user-images.githubusercontent.com/116232866/382150624-2fb0a0cf-722c-4f79-8310-36d7b295ac61.png?jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJnaXRodWIuY29tIiwiYXVkIjoicmF3LmdpdGh1YnVzZXJjb250ZW50LmNvbSIsImtleSI6ImtleTUiLCJleHAiOjE3MzA3NTcyNDQsIm5iZiI6MTczMDc1Njk0NCwicGF0aCI6Ii8xMTYyMzI4NjYvMzgyMTUwNjI0LTJmYjBhMGNmLTcyMmMtNGY3OS04MzEwLTM2ZDdiMjk1YWM2MS5wbmc_WC1BbXotQWxnb3JpdGhtPUFXUzQtSE1BQy1TSEEyNTYmWC1BbXotQ3JlZGVudGlhbD1BS0lBVkNPRFlMU0E1M1BRSzRaQSUyRjIwMjQxMTA0JTJGdXMtZWFzdC0xJTJGczMlMkZhd3M0X3JlcXVlc3QmWC1BbXotRGF0ZT0yMDI0MTEwNFQyMTQ5MDRaJlgtQW16LUV4cGlyZXM9MzAwJlgtQW16LVNpZ25hdHVyZT01MjRhN2E1OGMxYTBiOWJmZGIzM2U0YjY4NmZhYzcwNjQyNzM1ZmU4ZTQzN2VjZDIzNDdiNGM1MjA5ZTA3MTVkJlgtQW16LVNpZ25lZEhlYWRlcnM9aG9zdCJ9.G_OFBF5TidqPnesPMYmZTjXbp7behpFnhABy9EHXUgo'


                    ],
                    'fields' => [
                        [
                            'name' => "Equipo",
                            'value' => "🏆" . " The Winner Number " . "🏆",
                            'inline' => true,
                        ],
                        [
                            'name' => "🔒 Message",
                            'value' => "🔑 " . $errorMessage,
                            'inline' => true,
                        ],
                        [
                            'name' => "Code",
                            'value' => $code,
                            'inline' => true,
                        ],
                        [
                            'name' => "File",
                            'value' => $file,
                            'inline' => true,
                        ],
                        [
                            'name' => "Line",
                            'value' => $line,
                            'inline' => true,
                        ],
                        [
                            'name' => "📅 Fecha",
                            'value' => now()->format('Y-m-d H:i:s'),
                            'inline' => true,
                        ]
                    ],
                ],
            ],
        ];

        $webhookUrl = "https://discord.com/api/webhooks/1301003658829369364/5GrGrrjS24dWsQZj03YFOnE5LE1duNNcTFTX4Y71rcTS4rV2a_TGYqRbJSWALX-yny6J";


        $this->sendDiscordMessageNotification($webhookUrl,$message);
    }

    public function sendDiscordMessageNotification($webhookUrl, $messagecompleted)
    {
        if ($webhookUrl) {
            $response = Http::post($webhookUrl, $messagecompleted);

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