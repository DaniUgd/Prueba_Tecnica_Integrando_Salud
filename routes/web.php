<?php

use App\Models\Tratamiento;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\TipoPetController;
use App\Http\Controllers\TratamientoController;


Route::get('/', function () {
        return view('inicio');
    })->name('inicio');




// Pacientes
Route::get('/pacientes', [PacienteController::class, 'listar'])->name('pacientes.listar');
Route::get('/pacientes/nuevo', [PacienteController::class, 'crear'])->name('pacientes.crear');
Route::post('/pacientes', [PacienteController::class, 'guardar'])->name('pacientes.guardar');
Route::get('/pacientes/{paciente}/editar', [PacienteController::class, 'editar'])->name('pacientes.editar');
Route::put('/pacientes/{paciente}', [PacienteController::class, 'actualizar'])->name('pacientes.actualizar');

// Tratamientos de un paciente
Route::get('/pacientes/{paciente}/tratamientos', [TratamientoController::class, 'listar'])->name('pacientes.tratamientos.listar');
Route::get('/pacientes/{paciente}/tratamientos/nuevo', [TratamientoController::class, 'crear'])->name('pacientes.tratamientos.crear');
Route::post('/pacientes/{paciente}/tratamientos', [TratamientoController::class, 'guardar'])->name('pacientes.tratamientos.guardar');

// Tipos de Pet
Route::get('/tipos-pet', [TipoPetController::class, 'listar'])->name('tipos-pet.listar');
Route::get('/tipos-pet/nuevo', [TipoPetController::class, 'crear'])->name('tipos-pet.crear');
Route::post('/tipos-pet', [TipoPetController::class, 'guardar'])->name('tipos-pet.guardar');
Route::get('/tipos-pet/{tipoPet}/editar', [TipoPetController::class, 'editar'])->name('tipos-pet.editar');
Route::put('/tipos-pet/{tipoPet}', [TipoPetController::class, 'actualizar'])->name('tipos-pet.actualizar');
Route::delete('/tipos-pet/{tipoPet}', [TipoPetController::class, 'eliminar'])->name('tipos-pet.eliminar');