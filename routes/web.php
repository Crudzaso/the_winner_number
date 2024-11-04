<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return view('welcome');
});

//ROUTES FOR CHECK THE LAYOUTS
Route::get("/componente", function(){
    return view('components.prueba-layout');
});

Route::get("/sign-in",function(){
    return view('components.sign-in');
});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Ruta para redirigir a Google
Route::get('auth/google', [AuthenticatedSessionController::class, 'redirectToGoogle'])->name('auth.google');

// Ruta para manejar la respuesta de Google
Route::get('auth/google/callback', [AuthenticatedSessionController::class, 'handleGoogleCallback']);
