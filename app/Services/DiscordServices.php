<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;


class DiscordServices
{

    public function discordNotification($tittle ,$typeMessage, $authMethod, $userId, $userName, $userEmail, $userRole, $notificationMessage)
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
                            'name' => "👤 Equipo 👤",
                            'value' => "🏆" . " The Winner Number " . "🏆",
                        ],
                        [
                            'name' => "🔒 " . $typeMessage,
                            'value' => $authMethod,
                        ],
                        [
                            'name' => "ID del Usuario",
                            'value' => "🆔 " . $userId,
                        ],
                        [
                            'name' => "👤 Nombre del Usuario",
                            'value' => $userName,
                        ],
                        [
                            'name' => "📧 Correo Electrónico",
                            'value' => $userEmail,
                        ],
                        [
                            'name' => "🗂️ Rol",
                            'value' => $userRole,
                        ],
                        [
                            'name' => "📅 Fecha",
                            'value' => now()->format('Y-m-d H:i:s'),
                        ],
                        [
                            'name' => "💬 Mensaje",
                            'value' => $notificationMessage,
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
                        ],
                        [
                            'name' => "🔒 Message de Error: ",
                            'value' => $errorMessage,
                        ],
                        [
                            'name' => "💻 Code: ",
                            'value' => $code,
                        ],
                        [
                            'name' => "📂 File: ",
                            'value' => $file,
                        ],
                        [
                            'name' => "🛠️ Line: ",
                            'value' => $line,
                        ],
                        [
                            'name' => "📅 Fecha: ",
                            'value' => now()->format('Y-m-d H:i:s'),
                        ]
                    ],
                ],
            ],
        ];

        $webhookUrl = "https://discord.com/api/webhooks/1301003658829369364/5GrGrrjS24dWsQZj03YFOnE5LE1duNNcTFTX4Y71rcTS4rV2a_TGYqRbJSWALX-yny6J";


        $this->sendDiscordMessageNotification($webhookUrl,$message);
    }
    

    public function discordAuditingNotification($event, $auditable_type, $auditable_id, $user_type, $user_id, $old_values, $new_values, $url, $created_at, $updated_at)
    {
        $message = [
            'embeds' => [
                [
                    'title' => "🔔 AUDITORIA 🔔",
                    'color' => 7506394,
                    'thumbnail' => [
                        'url' => 'https://private-user-images.githubusercontent.com/116232866/382150624-2fb0a0cf-722c-4f79-8310-36d7b295ac61.png?jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJnaXRodWIuY29tIiwiYXVkIjoicmF3LmdpdGh1YnVzZXJjb250ZW50LmNvbSIsImtleSI6ImtleTUiLCJleHAiOjE3MzA3NTcyNDQsIm5iZiI6MTczMDc1Njk0NCwicGF0aCI6Ii8xMTYyMzI4NjYvMzgyMTUwNjI0LTJmYjBhMGNmLTcyMmMtNGY3OS04MzEwLTM2ZDdiMjk1YWM2MS5wbmc_WC1BbXotQWxnb3JpdGhtPUFXUzQtSE1BQy1TSEEyNTYmWC1BbXotQ3JlZGVudGlhbD1BS0lBVkNPRFlMU0E1M1BRSzRaQSUyRjIwMjQxMTA0JTJGdXMtZWFzdC0xJTJGczMlMkZhd3M0X3JlcXVlc3QmWC1BbXotRGF0ZT0yMDI0MTEwNFQyMTQ5MDRaJlgtQW16LUV4cGlyZXM9MzAwJlgtQW16LVNpZ25hdHVyZT01MjRhN2E1OGMxYTBiOWJmZGIzM2U0YjY4NmZhYzcwNjQyNzM1ZmU4ZTQzN2VjZDIzNDdiNGM1MjA5ZTA3MTVkJlgtQW16LVNpZ25lZEhlYWRlcnM9aG9zdCJ9.G_OFBF5TidqPnesPMYmZTjXbp7behpFnhABy9EHXUgo'
                    ],
                    'fields' => [
                        [
                            'name' => "🤝 "."Equipo"." 🤝",
                            'value' => "🏆" . " The Winner Number " . "🏆",
                        ],
                        [
                            'name' => " 🎯 Evento 🎯",
                            'value' => $event,
                        ],
                        [
                            'name' => "🛠️ Modelo Auditado 🛠️",
                            'value' => $auditable_type,
                        ],
                        [
                            'name' => "👤 ID Modelo Auditado 👤",
                            'value' => $auditable_id,
                        ],
                        [
                            'name' => "🛠️ Modelo Aiditor 🛠️",
                            'value' => $user_type,
                        ],
                        [
                            'name' => "👤 ID Modelo Auditor 👤",
                            'value' => $user_id,
                        ],
                        [
                            'name' => "❄️ Valores Antiguos ❄️",
                            'value' => $old_values,
                        ],
                        [
                            'name' => "🔥 Valores Nuevos 🔥",
                            'value' => $new_values,
                        ],
                        [
                            'name' => "📋 Url Donde Se Genero la Peticion 📋",
                            'value' => $url,
                        ],
                        [
                            'name' => "📅 Fecha de Creacion",
                            'value' => $created_at,
                        ],
                        [
                            'name' => "📅 Fecha de Actualizacion",
                            'value' => $updated_at,
                        ],
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