<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoPet;


class TipoPetController extends Controller
{
   public function listar(Request $request)
    {
        // Los valores posibles: activos | inactivos | todos
        $estado = $request->get('estado', 'activos');

        $query = TipoPet::query();

        if ($estado === 'activos') {
            $query->where('activo', True);
        } elseif ($estado === 'inactivos') {
            $query->where('activo', False);
        } // 'todos' no filtra

        $tipos = $query->orderByDesc('id')->get();

        return view('tipos_pet.listar', compact('tipos', 'estado'));
    }

    public function crear()
    {
        return view('tipos_pet.crear');
    }

    public function guardar(Request $request){
        try {
            $validated = $request->validate([
                'nombre'           => 'required|string|max:100',
                'color'            => 'required|in:verde,amarillo,ambar,rojo',
                'intensidad'       => 'required|integer|min:1|max:10',
                'duracion_minutos' => 'required|integer|min:1|max:600',
                'requiere_ayuno'   => 'required|boolean',
                'observaciones'    => 'nullable|string',
            ], [
                'nombre.required'           => 'El nombre es obligatorio',
                'color.required'            => 'Debe seleccionar un color',
                'color.in'                  => 'El color debe ser verde, amarillo, ámbar o rojo',
                'intensidad.required'       => 'La intensidad es obligatoria',
                'intensidad.min'            => 'La intensidad debe ser entre 1 y 10',
                'intensidad.max'            => 'La intensidad debe ser entre 1 y 10',
                'duracion_minutos.required' => 'La duración es obligatoria',
                'requiere_ayuno.required'   => 'Debe indicar si requiere ayuno',
            ]);            
           
            TipoPet::create($validated);

            return redirect()->route('tipos-pet.listar')->with('success', 'Tipo de PET creado correctamente.');
        } 
        catch (\Exception $e) {
            \Log::error('Error al crear tipo de PET: '.$e->getMessage());
            return back()->with('error', 'Ocurrió un error inesperado. Intente nuevamente.')->withInput();
        }
    }   
        public function editar($id)
    {
        $tipoPet=TipoPet::findOrFail($id);
        return view ('tipos_pet.editar', compact('tipoPet'));
    }

    public function actualizar(Request $request, TipoPet $tipoPet){
        try {
            $validated = $request->validate([
                'nombre'           => 'required|string|max:100',
                'color'            => 'required|in:verde,amarillo,ambar,rojo',
                'intensidad'       => 'required|integer|min:1|max:10',
                'duracion_minutos' => 'required|integer|min:1|max:600',
                'requiere_ayuno'   => 'required|boolean',
                'observaciones'    => 'nullable|string',
                'activo'           => 'required|boolean',
            ], [
                'nombre.required' => 'El nombre es obligatorio',
                'color.required'  => 'Debe seleccionar un color válido',
                'intensidad.min'  => 'La intensidad debe ser mínimo 1',
                'intensidad.max'  => 'La intensidad debe ser máximo 10',
                'duracion_minutos.required' => 'La duración es obligatoria',
                'activo.required' => 'Debe indicar el estado del PET',
            ]);
            $validated['actualizar_at'] = now();
            $tipoPet->update($validated);
            return redirect()->route('tipos-pet.listar')->with('success', 'Tipo de PET actualizado correctamente.');
            } 
            catch (\Exception $e) {
                \Log::error('Error al actualizar TipoPet: '.$e->getMessage());
                return back()->with('error', 'Ocurrió un error inesperado.')->withInput();
            }
    }
}
