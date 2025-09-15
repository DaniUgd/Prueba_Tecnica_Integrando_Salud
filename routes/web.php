<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    //Route::resource('pacientes', PacienteController::class);
    return view('welcome');
    
});

Route::get('/inicio', function () {
        return view('inicio');
    });
