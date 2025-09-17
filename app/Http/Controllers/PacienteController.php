<?php

namespace App\Http\Controllers;
use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
      public function listar(Request $request){
        $query = Paciente::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('dni', 'like', '%' . $search . '%')->orWhere('apellido', 'like', '%' . $search . '%');
        }
        $pacientes = $query->orderBy('id', 'desc')->get();
        return view('pacientes.listar', compact('pacientes'));
        }
    public function crear(){
        return view("pacientes.crear");
    }
    public function guardar(Request $request){
        try {
            $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'dni' => 'required|string|max:20|unique:pacientes',
            'sexo' => 'required|string|in:Masculino,Femenino,Otro',
            'fecha_nacimiento' => 'required|date',
        ]);
        
        Paciente::create($validated);
        return redirect()->route('pacientes.listar')->with('success','Paciente creado Correctamente');
        
        }
        catch (\Exception $e) {
            \Log::error('Error al crear paciente: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->with('error', 'Ocurrió un error inesperado. Intente nuevamente.')
                ->withInput();
        }   

    }
    public function editar(Paciente $paciente){
        return view('pacientes.editar', compact('paciente'));
     }
     public function actualizar(Request $request, Paciente $paciente){
        try {
            $validated = $request->validate([
            'nombre' => 'required|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/u|max:60',
            'apellido' => 'required|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/u|max:60',
            'dni' => 'required|numeric|max_digits:20',
            'sexo' => 'required|in:Masculino,Femenino,Otro',
            'fecha_nacimiento' => 'required|date|after_or_equal:1900-01-01|before_or_equal:today',
        ], [
            'nombre.required' => 'El campo Nombre es obligatorio',
            'nombre.regex' => 'El Nombre solo puede contener letras',
            'nombre.max' => 'El Nombre no puede tener más de 60 caracteres',

            'apellido.required' => 'El campo Apellido es obligatorio',
            'apellido.regex' => 'El Apellido solo puede contener letras',
            'apellido.max' => 'El Apellido no puede tener más de 60 caracteres',

            'dni.required' => 'El campo DNI es obligatorio',
            'dni.numeric' => 'El DNI solo puede contener números',
            'dni.max_digits' => 'El DNI no puede tener más de 20 caracteres',

            'sexo.required' => 'Debe seleccionar el sexo',
            'sexo.in' => 'Seleccione una opción válida para el sexo',

            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria',
            'fecha_nacimiento.date' => 'Debe ingresar una fecha válida',
            'fecha_nacimiento.after_or_equal' => 'La fecha no puede ser anterior al 01/01/1900',
            'fecha_nacimiento.before_or_equal' => 'La fecha no puede ser posterior a hoy',
        ]);
        $validated['actualizar_at'] = now();
        $paciente->update($validated);
        return redirect()->route('pacientes.listar')->with('success', 'Paciente actualizado correctamente.');
      }
      catch (\Exception $e) {
        \Log::error('Error al crear paciente: '.$e->getMessage(), [
            'trace' => $e->getTraceAsString()
        ]);
        return back()->with('error', 'Ocurrió un error inesperado. Intente nuevamente.')->withInput();
      }   

    }
  
    
      
}


