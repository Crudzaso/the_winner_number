<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\RaffleController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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

Route::view('/user/forminformationuser/termsAndCondicion', 'viewtemplate.termsAndConditions')->name('termsAndConditions');
Route::view('/user/forminformationuser/privacyPolicy', 'viewtemplate.privacyPolicy')->name('privacyPolicy');

Route::middleware('auth')->group(function () {

    Route::get('/user/forminformationuser', [UserController::class, 'formInformationUser'])->name('user.forminformationuser');
    Route::post('/user/completeregistration', [UserController::class, 'completeRegistration'])->name('user.completeregistration');

    Route::get('/raffles', [RaffleController::class, 'index'])->name('raffle.index')->middleware('permission:raffles.index');
    Route::get('/raffles/myraffles', [RaffleController::class, 'myindex'])->name('raffle.myindex')->middleware('permission:raffles.myindex');
    Route::get('/raffles/create',[RaffleController::class, 'create'])->name('raffle.create')->middleware('permission:raffles.store');
    Route::post('/raffles', [RaffleController::class, 'store'])->name('raffle.store')->middleware('permission:raffles.store');
    Route::get('/raffles/{raffle}/show', [RaffleController::class, 'show'])->name('raffle.show')->middleware('permission:raffles.show');
    Route::get('/raffles/{raffle}/edit', [RaffleController::class, 'edit'])->name('raffle.edit')->middleware('permission:raffles.edit');
    Route::put('/raffles/{raffle}', [RaffleController::class, 'update'])->name('raffle.update')->middleware('permission:raffles.edit');
    Route::patch('/raffles/{raffle}', [RaffleController::class, 'destroy'])->name('raffle.destroy')->middleware('permission:raffles.destroy');


    Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchase.index')->middleware('permission:purchases.index');
    Route::get('/purchases/create/{raffle}', [PurchaseController::class, 'create'])->name('purchase.create')->middleware('permission:purchases.store');
    Route::post('/purchases', [PurchaseController::class, 'store'])->name('purchase.store')->middleware('permission:purchases.store');
    Route::get('/purchases/{purchase}', [PurchaseController::class, 'show'])->name('purchase.show')->middleware('permission:purchases.show');
    Route::get('/purchases/sales', [PurchaseController::class, 'sales'])->name('purchase.sales')->middleware('permission:purchases.sales');

    Route::middleware('role:admin')->group(function () {
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

        Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
        Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
        Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
        Route::get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
        Route::put('/permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
        Route::patch('/permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
    });
});
