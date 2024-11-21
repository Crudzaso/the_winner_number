<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Services\DiscordServices;


class ErrorServices
{

    private DiscordServices $discordServices;

    public function __construct(
        DiscordServices $discordServices
    )
    {
        $this->discordServices = $discordServices;
    }

    public function handleError(callable $request)
    {
        try {
            return $request();
        } catch (ModelNotFoundException $e) {
            $this->sendNotification("ModelNotFoundException",$e);
            return view('viewtemplate.notFound');
        } catch (AuthorizationException $e) {
            $this->sendNotification("AuthorizationException",$e);            
            return redirect()->route('raffle.index')->with('success', 'El recuerso al que intentaste accesder no esta permitido.');
        } catch (AuthenticationException $e) {
            $this->sendNotification("AuthenticationException",$e);
            return redirect()->route('components.sign-in');
        } catch (ThrottleRequestsException $e) {
            $this->sendNotification("ThrottleRequestsException",$e);
            return redirect()->route('components.sing-in');
        } catch (RouteNotFoundException $e) {
            $this->sendNotification("RouteNotFoundException",$e);
            \Log::error('Error', $e);
            return view('viewtemplate.notFound');
        } catch (MethodNotAllowedHttpException $e) {
            $this->sendNotification("MethodNotAllowedHttpException",$e);
            return redirect()->route('raffle.index')->with('success', 'El recuerso al que intentaste accesder no esta permitido.');
        } catch (NotFoundHttpException $e) {
            $this->sendNotification("NotFoundHttpException",$e);
            return view('viewtemplate.notFound');
        } catch (TokenMismatchException $e) {
            $this->sendNotification("TokenMismatchException",$e);
            return redirect()->route('raffle.index')->with('success', 'El recuerso al que intentaste accesder no esta permitido.');
        } catch (QueryException $e) {
            $this->sendNotification("QueryException",$e);
            return view('viewtemplate.dataBaseError');
        } catch (\Exception $e) {
            $this->sendNotification("Global Exception", $e);
            return view('viewtemplate.dataBaseError');
        }
    }

    public function sendNotification(string $exceptionType, \Exception $e)
    {
        Log::error("Error Inesperado", [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'code' => $e->getCode()
        ]);

        $this->discordServices->discordErrorNotification(
            $exceptionType,
            $e->getMessage(),
            $e->getCode(),
            $e->getFile(),
            $e->getLine()
        );
    }
}
