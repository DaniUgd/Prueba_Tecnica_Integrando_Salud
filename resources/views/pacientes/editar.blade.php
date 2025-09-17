@extends('layouts.app')

@section('title', 'Editar Paciente')

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Editar Paciente</h4>
    </div>
    <div class="card-body">

        {{-- Mensajes de error --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                Hay errores en el formulario:
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Mensaje de error general --}}
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('pacientes.actualizar', $paciente->id) }}" method="POST" id="pacienteForm">
            @csrf
            @method('PUT')

            {{-- Nombre --}}
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" 
                       name="nombre" 
                       id="nombre" 
                       class="form-control" 
                       value="{{ old('nombre', $paciente->nombre) }}" 
                       required maxlength="60"
                       pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+"
                       oninvalid="
                       if (!this.value) {
                            this.setCustomValidity('El campo Nombre es obligatorio');
                        } else {
                            this.setCustomValidity('El Nombre solo puede contener letras');
                        }"
                       oninput="this.setCustomValidity('')">
            </div>

            {{-- Apellido --}}
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" 
                       name="apellido" 
                       id="apellido" 
                       class="form-control" 
                       value="{{ old('apellido', $paciente->apellido) }}" 
                       required maxlength="60"
                       pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+"
                       oninvalid="
                       if (!this.value) {
                            this.setCustomValidity('El campo Apellido es obligatorio');
                        } else {
                            this.setCustomValidity('El Apellido solo puede contener letras');
                        }"
                       oninput="this.setCustomValidity('')">
            </div>

            {{-- DNI --}}
            <div class="mb-3">
                <label for="dni" class="form-label">DNI</label>
                <input type="text" 
                       name="dni" 
                       id="dni" 
                       class="form-control" 
                       value="{{ old('dni', $paciente->dni) }}" 
                       required pattern="[0-9]+"
                       maxlength="20"
                       oninvalid="
                       if (!this.value) {
                            this.setCustomValidity('El campo DNI es obligatorio');
                        } else if (!/^[0-9]+$/.test(this.value)) {
                            this.setCustomValidity('El DNI solo puede contener números');
                        } else if (this.value.length > 20) {
                            this.setCustomValidity('El DNI no puede tener más de 20 caracteres');
                        }"
                       oninput="this.setCustomValidity('')">
            </div>

            {{-- Sexo --}}
            <div class="mb-3">
                <label for="sexo" class="form-label">Sexo</label>
                <select name="sexo" id="sexo" class="form-select" required
                        oninvalid="this.setCustomValidity('Por favor seleccione una opción')"
                        oninput="this.setCustomValidity('')">
                    <option value="">Seleccione...</option>
                    <option value="Masculino" {{ old('sexo', $paciente->sexo) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="Femenino" {{ old('sexo', $paciente->sexo) == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                    <option value="Otro" {{ old('sexo', $paciente->sexo) == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>

            {{-- Fecha de nacimiento --}}
            <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                <input type="date" 
                       name="fecha_nacimiento" 
                       id="fecha_nacimiento" 
                       class="form-control" 
                       value="{{ old('fecha_nacimiento', $paciente->fecha_nacimiento) }}" 
                       min="1900-01-01"
                       max="{{ now()->format('Y-m-d') }}"
                       required 
                       oninvalid="this.setCustomValidity('Por favor seleccione una fecha válida entre 01/01/1900 y la fecha de hoy')"
                       oninput="
                       this.setCustomValidity('');
                       if (this.value && this.max && this.value > this.max) {
                            this.setCustomValidity('La fecha no puede ser posterior a hoy');
                        }">
            </div>

            {{-- Botones --}}
            <div class="d-flex justify-content-end">
                <a href="{{ route('pacientes.listar') }}" class="btn btn-secondary me-2">Cancelar</a>
                <button type="submit" class="btn btn-primary" id="btnGuardar" disabled>Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>

{{-- Script para habilitar el botón solo si se modifica algo --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('pacienteForm');
    const btnGuardar = document.getElementById('btnGuardar');
    const initialData = new FormData(form);

    form.addEventListener('input', function () {
        const currentData = new FormData(form);
        let changed = false;

        for (let [key, value] of currentData.entries()) {
            if (value !== initialData.get(key)) {
                changed = true;
                break;
            }
        }

        btnGuardar.disabled = !changed;
    });
});
</script>
@endsection