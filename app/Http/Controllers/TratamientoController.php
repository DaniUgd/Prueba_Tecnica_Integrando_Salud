<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use App\Models\TipoPet;
use App\Models\Tratamiento;
use Illuminate\Validation\Rule;

class TratamientoController extends Controller
{
    public function listar(Paciente $paciente)
    {
        
        $tratamientos = $paciente->tratamientos()
            ->with('pet')            
            ->orderByDesc('id')
            ->get();

        return view('tratamientos.listar', compact('paciente', 'tratamientos'));
    }

    public function crear(Paciente $paciente){
        $pets  = TipoPet::where('activo',true)->orderBy('nombre')->get(['id','nombre']);
        return view('tratamientos.crear', compact('paciente','pets'));
    }
    public function guardar(Request $request, Paciente $paciente)
    {
        try {
            // Validaciones
            $validated = $request->validate([
                'pets_id' => [
                    'required',
                    // existe en la tabla pets y está activo = 1
                    Rule::exists('pets', 'id')->where(fn ($q) => $q->where('activo', 1)),
                ],
                'fecha_inicio' => 'required|date|before_or_equal:today',
            ], [
                'pets_id.required' => 'Debe seleccionar un Tipo de PET',
                'pets_id.exists'   => 'El Tipo de PET seleccionado no es válido o no está activo',
                'fecha_inicio.required' => 'La fecha de inicio es obligatoria',
                'fecha_inicio.date'     => 'Debe ingresar una fecha válida',
                'fecha_inicio.before_or_equal' => 'La fecha no puede ser posterior a hoy',
            ]);

            // Crear tratamiento
            Tratamiento::create([
                'pacientes_id'  => $paciente->id,           // FK según tu migración
                'pets_id'       => $validated['pets_id'],
                'fecha_inicio'  => $validated['fecha_inicio'],
            ]);

            return redirect()
                ->route('pacientes.tratamientos.listar', $paciente->id)
                ->with('success', 'Tratamiento registrado correctamente.');

        } catch (\Exception $e) {
            \Log::error('Error al crear tratamiento: '.$e->getMessage());
            return back()->with('error', 'Ocurrió un error inesperado.')->withInput();
        }
    }
    
}