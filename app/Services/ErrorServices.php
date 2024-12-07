<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Facades\DiscordFacade;
use Symfony\Component\HttpKernel\Exception\HttpException;


class ErrorServices
{

    private DiscordServices $discordServices;

    public function __construct(){}

    public function handleError(callable $request)
    {
        try {

            return $request();

        } catch (\Exception $e) {

            Log::error("Error Inesperado", [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'code' => $e->getCode()
            ]);

            if ($e instanceof HttpException) {
                $error = [
                    'message' => 'HTTP Exception: ' . $e->getMessage(),
                    'status' => $e->getStatusCode(),
                ];
            } else {
                $error = [
                    'message' => 'Server Exception: ' . $e->getMessage(),
                    'status' => 500,
                ];
            }

            DiscordFacade::discordErrorNotification(
                $error['status'],
                $e->getMessage(),
                $e->getFile(),
                $e->getLine(),
                $e->getCode()
            );

            return view('viewtemplate.error', compact('error'));
            
        }
    }
}
