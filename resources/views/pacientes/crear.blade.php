@extends('layouts.app')

@section('title', 'Nuevo Paciente')

@section('content')
<div class="card shadow">
    <div class="card-header bg-success text-white">
        <h4 class="mb-0">Registrar Nuevo Paciente</h4>
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

        
        <form action="{{ route('pacientes.guardar') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" 
                       name="nombre" 
                       id="nombre" 
                       class="form-control" 
                       value="{{ old('nombre') }}" 
                       required
                       maxlength="60"
                       pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+"
                       oninvalid="
                       if (!this.value) {
                            this.setCustomValidity('El campo Nombre es obligatorio');
                        }
                        else {
                            this.setCustomValidity('El Nombre solo puede contener letras');
                        }"
                        oninput="this.setCustomValidity('')">

            </div>

            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" 
                       name="apellido" 
                       id="apellido" 
                       class="form-control" 
                       value="{{ old('apellido') }}" 
                       required
                       maxlength="60"
                       pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+"
                       oninvalid="
                       if (!this.value) {
                            this.setCustomValidity('El campo Apellido es obligatorio');
                        }
                        else {
                            this.setCustomValidity('El Apellido solo puede contener letras');
                        }"
                        oninput="this.setCustomValidity('')">
            </div>

            <div class="mb-3">
                <label for="dni" class="form-label">DNI</label>
                <input type="text" 
                       name="dni" 
                       id="dni" 
                       class="form-control" 
                       value="{{ old('dni') }}" 
                       required
                       pattern="[0-9]+"
                       maxlength="20"
                       oninvalid=
                       "if (!this.value) {
                            this.setCustomValidity('El campo DNI es obligatorio');
                        } 
                        else if (!/^[0-9]+$/.test(this.value)) {
                            this.setCustomValidity('El DNI solo puede contener números');
                        }"
                        oninput="this.setCustomValidity('')">
            </div>      

            <div class="mb-3">
                <label for="sexo" class="form-label">Sexo</label>
                <select name="sexo" id="sexo" class="form-select" required 
                oninvalid="this.setCustomValidity('Por favor seleccione una opcion')"
                oninput="this.setCustomValidity('')">
                    <option value="">Seleccione...</option>
                    <option value="Masculino" {{ old('sexo') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="Femenino" {{ old('sexo') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                    <option value="Otro" {{ old('sexo') == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>
          
            <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label" >Fecha de nacimiento</label>
                <input type="date" 
                       name="fecha_nacimiento" 
                       id="fecha_nacimiento" 
                       class="form-control" 
                       value="{{ old('fecha_nacimiento') }}" 
                       min="1900-01-01"
                       max="{{ now() }}"
                       required oninvalid="this.setCustomValidity('Por favor seleccione una fecha valida entre 01/01/1900 y la fecha de hoy')"
                       oninput="
                       this.setCustomValidity('');
                       if (this.value && this.max && this.value > this.max) {
                            this.setCustomValidity('La fecha no puede ser posterior a hoy');
                        }">
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('pacientes.listar') }}" class="btn btn-secondary me-2">Cancelar</a>
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection