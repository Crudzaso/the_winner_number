<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\DiscordServices;



class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        

                // En FortifyServiceProvider.php
        Fortify::authenticateUsing(function (Request $request) {

            $user = User::where('email', $request->email)->first();

            if ($user && \Hash::check($request->password, $user->password)) {

                if ($user->status == false) {
                    abort(403, 'El usuario ha sido desactivado. Por favor contacte al administrador.');
                }

                Auth::login($user);

                // Información para la notificación
                $companyName = "The winner number";
                $logoUrl = 'https://private-user-images.githubusercontent.com/116232866/382150624-2fb0a0cf-722c-4f79-8310-36d7b295ac61.png?jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJnaXRodWIuY29tIiwiYXVkIjoicmF3LmdpdGh1YnVzZXJjb250ZW50LmNvbSIsImtleSI6ImtleTUiLCJleHAiOjE3MzA3NTcyNDQsIm5iZiI6MTczMDc1Njk0NCwicGF0aCI6Ii8xMTYyMzI4NjYvMzgyMTUwNjI0LTJmYjBhMGNmLTcyMmMtNGY3OS04MzEwLTM2ZDdiMjk1YWM2MS5wbmc_WC1BbXotQWxnb3JpdGhtPUFXUzQtSE1BQy1TSEEyNTYmWC1BbXotQ3JlZGVudGlhbD1BS0lBVkNPRFlMU0E1M1BRSzRaQSUyRjIwMjQxMTA0JTJGdXMtZWFzdC0xJTJGczMlMkZhd3M0X3JlcXVlc3QmWC1BbXotRGF0ZT0yMDI0MTEwNFQyMTQ5MDRaJlgtQW16LUV4cGlyZXM9MzAwJlgtQW16LVNpZ25hdHVyZT01MjRhN2E1OGMxYTBiOWJmZGIzM2U0YjY4NmZhYzcwNjQyNzM1ZmU4ZTQzN2VjZDIzNDdiNGM1MjA5ZTA3MTVkJlgtQW16LVNpZ25lZEhlYWRlcnM9aG9zdCJ9.G_OFBF5TidqPnesPMYmZTjXbp7behpFnhABy9EHXUgo';
                $authMethod = "Usuario"; // O "Google" si es el caso
                $userId = $user->id;
                $userName = $user->name;
                $userEmail = $user->email;
                $date = now()->format('Y-m-d H:i:s'); // Fecha actual
                $notificationMessage = "Usuario ha iniciado sesión exitosamente.";

                (new \App\Http\Controllers\Auth\AuthenticatedSessionController())->sendDiscordNotification(
                    $companyName,
                    $logoUrl,
                    $authMethod,
                    $userId,
                    $userName,
                    $userEmail,
                    $date,
                    $notificationMessage
                );

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

                return $user;
            }
        });


        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(3)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
