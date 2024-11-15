<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\RaffleController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;


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

Route::view('/view','viewtemplate.viewlogin');
Route::view('/viewlayout','viewtemplate.viewlayout');

Route::get('/raffles', [RaffleController::class, 'index'])->name('raffle.index');
Route::get('/raffles/create',[RaffleController::class, 'create'])->name('raffle.create');
Route::post('/raffles', [RaffleController::class, 'store'])->name('raffle.store');
Route::get('/raffles/{raffle}', [RaffleController::class, 'show'])->name('raffle.show');
Route::get('/raffles/{raffle}/edit', [RaffleController::class, 'edit'])->name('raffle.edit');
Route::put('/raffles/{raffle}', [RaffleController::class, 'update'])->name('raffle.update');
Route::patch('/raffles/{raffle}', [RaffleController::class, 'destroy'])->name('raffle.destroy');


Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchase.index');
Route::get('/purchases/create/{raffle}', [PurchaseController::class, 'create'])->name('purchase.create');
Route::post('/purchases', [PurchaseController::class, 'store'])->name('purchase.store');
Route::get('/purchases/{purchase}', [PurchaseController::class, 'show'])->name('purchase.show');


Route::get('/user/forminformationuser', [UserController::class, 'formInformationUser'])->name('user.forminformationuser');
Route::post('/user/completeregistration', [UserController::class, 'completeRegistration'])->name('user.completeregistration');
Route::view('/user/forminformationuser/termsAndCondicion', 'viewtemplate.termsAndConditions')->name('termsAndConditions');
Route::view('/user/forminformationuser/privacyPolicy', 'viewtemplate.privacyPolicy')->name('privacyPolicy');
Route::get('/users/{status}', [UserController::class, 'index'])->name('user.index');
Route::get('/user/show/{user}', [UserController::class, 'show'])->name('user.show');
Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
Route::patch('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user', [UserController::class, 'store'])->name('user.store');

Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
