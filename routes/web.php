<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\RaffleController;


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



Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');
});

// Ruta para redirigir a Google
Route::get('/auth/google', [AuthenticatedSessionController::class, 'redirectToGoogle'])->name('auth.google');

// Ruta para manejar la respuesta de Google
Route::get('/auth/google/callback', [AuthenticatedSessionController::class, 'handleGoogleCallback']);

Route::view('/view','viewtemplate.viewlogin')->name('view.viewlogin');
Route::view('/viewlayout','viewtemplate.viewlayout');
Route::get('/raffles', [RaffleController::class, 'index'])->name('raffle.index');
Route::get('/raffles/create',[RaffleController::class, 'create'])->name('raffle.create');
Route::post('/raffles', [RaffleController::class, 'store'])->name('raffle.store');
Route::get('/raffles/{raffle}', [RaffleController::class, 'show'])->name('raffle.show');
Route::get('/raffles/{raffle}/edit', [RaffleController::class, 'edit'])->name('raffle.edit');
Route::put('/raffles/{raffle}', [RaffleController::class, 'update'])->name('raffle.update');
Route::patch('/raffles/{raffle}', [RaffleController::class, 'destroy'])->name('raffle.destroy');
