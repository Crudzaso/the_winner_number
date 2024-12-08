<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Facades\DiscordFacade;

class EmailServices
{
    /**
     * Create a new class instance.
     */
    public function __construct(){}

    public function sendEmail($subject, $userName, $userEmail, $messageContent){
        try {
            $data = [
                'subject' => $subject,
                'userName' => $userName,
                'userEmail' => $userEmail,
                'messageContent' => $messageContent,
        ];
            Mail::send('viewtemplate.emailMessage', $data, function ($message) use ($userEmail, $subject) {
                $message->to($userEmail)
                ->from(config('app.MAIL_FROM_ADDRESS'), config('app.MAIL_FROM_NAME'))
                ->subject($subject);
            });
            return true;
        } catch (\Exception $e) {
            Log::error("Error Inesperado", [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'code' => $e->getCode()
            ]);

            DiscordFacade::discordErrorNotification(
                "Error en el envio de correos",
                $e->getMessage(),
                $e->getFile(),
                $e->getLine(),
                $e->getCode()
            );
        }
    }

    public function welcomeMessage($user) {
        
        $subject = "Bienvenido a nuestra plataforma";
        $messageContent = "
            Hola {$user->name},
            ¡Estamos emocionados de que te hayas unido a nuestra comunidad! 🚀
            En nuestra plataforma, tendrás la oportunidad de participar en rifas increíbles y ganar premios que cambiarán tu día. Nos aseguramos de que todo sea justo, transparente y lleno de emoción.
            
            Si necesitas ayuda, estamos aquí para ti.

            Gracias por confiar en nosotros, y ¡mucha suerte en tu camino hacia la victoria! 🏆
            El equipo de <strong>The Winner Number
        ";
        $this->sendEmail($subject, $user->name, $user->email, $messageContent);
    }

    public function raffleCreateMessage($user, $raffle) {
        
        $subject = "¡Tu rifa está lista! 🎉";
        $messageContent = "
            ¡Felicidades, {$user->name}! Acabas de crear tu rifa {$raffle->name}. Ahora los participantes pueden empezar a inscribirse.
            Recuerda
                🛠 Tu Rifa juega:</strong>{$raffle->closing_date}
                📊 Seguir su progreso:</strong> Revisa cuántos boletos se han vendido y mantén el control.

            ¡Gracias por confiar en nosotros para hacer tu rifa un éxito! 💪
            El equipo de <strong>The Winner Number
        ";
        $this->sendEmail($subject, $user->name, $user->email, $messageContent);
    }

    public function purchaseCreateMessage($user, $raffle) {
        
        $subject = "¡Gracias por tu compra, {$user->name}! 🎫";
        $messageContent = "
            Tu participación en la rifa {$raffle->name} está confirmada.
    
                📅 Fecha del sorteo: {$raffle->closing_date}
    
            ¡Te deseamos la mejor de las suertes! 🍀
        
            ¡Gracias por confiar en nosotros! Si necesitas ayuda, no dudes en contactarnos. 💌
            El equipo de The Winner Number
        ";
        $this->sendEmail($subject, $user->name, $user->email, $messageContent);
    }

    
}
