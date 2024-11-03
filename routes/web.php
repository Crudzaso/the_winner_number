<?php

use Illuminate\Support\Facades\Route;

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
