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

Route::view('/usuario/formulario-informacion-requerida/terminos-y-condiciones', 'viewtemplate.termsAndConditions')->name('termsAndConditions');
Route::view('/usuario/formulario-informacion-requerida/politicas-de-privacidad', 'viewtemplate.privacyPolicy')->name('privacyPolicy');

Route::middleware('auth')->group(function () {

    Route::get('/usuario/formulario-informacion-requerida', [UserController::class, 'formInformationUser'])->name('user.forminformationuser');
    Route::post('/user/completar-registro', [UserController::class, 'completeRegistration'])->name('user.completeregistration');

    Route::get('/rifas', [RaffleController::class, 'index'])->name('raffle.index')->middleware('permission:raffles.index');
    Route::get('/rifas/mis-rifas', [RaffleController::class, 'myindex'])->name('raffle.myindex')->middleware('permission:raffles.myindex');
    Route::get('/rifas/crear',[RaffleController::class, 'create'])->name('raffle.create')->middleware('permission:raffles.store');
    Route::post('/rifas', [RaffleController::class, 'store'])->name('raffle.store')->middleware('permission:raffles.store');
    Route::get('/rifas/{raffle}/destalles', [RaffleController::class, 'show'])->name('raffle.show')->middleware('permission:raffles.show');
    Route::get('/rifas/{raffle}/editar', [RaffleController::class, 'edit'])->name('raffle.edit')->middleware('permission:raffles.edit');
    Route::put('/rifas/{raffle}', [RaffleController::class, 'update'])->name('raffle.update')->middleware('permission:raffles.edit');
    Route::patch('/rifas/{raffle}', [RaffleController::class, 'destroy'])->name('raffle.destroy')->middleware('permission:raffles.destroy');


    Route::get('/compras', [PurchaseController::class, 'index'])->name('purchase.index')->middleware('permission:purchases.index');
    Route::get('/compras/creatr/{raffle}', [PurchaseController::class, 'create'])->name('purchase.create')->middleware('permission:purchases.store');
    Route::post('/compras', [PurchaseController::class, 'store'])->name('purchase.store')->middleware('permission:purchases.store');
    Route::get('/compras/{purchase}', [PurchaseController::class, 'show'])->name('purchase.show')->middleware('permission:purchases.show');
    Route::get('/ventas', [PurchaseController::class, 'sales'])->name('purchase.sales')->middleware('permission:purchases.sales');

    Route::middleware('role:admin')->group(function () {
        Route::get('/usuarios/{status}', [UserController::class, 'index'])->name('user.index');
        Route::get('/usuario/detalles/{user}', [UserController::class, 'show'])->name('user.show');
        Route::get('/usuario/{user}/editar', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/usuario/{user}', [UserController::class, 'update'])->name('user.update');
        Route::patch('/usuario/{user}', [UserController::class, 'destroy'])->name('user.destroy');
        Route::get('/usuario/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/usuario', [UserController::class, 'store'])->name('user.store');

        Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
        Route::get('/roles/crear', [RoleController::class, 'create'])->name('roles.create');
        Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
        Route::get('/roles/{role}/editar', [RoleController::class, 'edit'])->name('roles.edit');
        Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
        Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
        Route::delete('/roles/revocar/{id}/{role}', [RoleController::class, 'revokeRole'])->name('roles.revokeRole');
        Route::post('/roles/asignar/{id}/{role}', [RoleController::class, 'assignRole'])->name('roles.assignRole');

        Route::get('/permisos', [PermissionController::class, 'index'])->name('permissions.index');
        Route::get('/permisos/create', [PermissionController::class, 'create'])->name('permissions.create');
        Route::post('/permisos', [PermissionController::class, 'store'])->name('permissions.store');
        Route::get('/permisos/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
        Route::put('/permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
        Route::delete('/permisos/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
        Route::delete('/permisos/revocar/{model}/{id}/{permission}', [PermissionController::class, 'revokePermission'])->name('permissions.revokepermission');
        Route::post('/permisos/asignar/{model}/{id}/{permission}', [PermissionController::class, 'assignPermission'])->name('permissions.assignpermission');
    });
});
