@extends('layouts.app')

@section('title', 'Nuevo tratamiento')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 ">
    <h1 class="h3">Nuevo tratamiento para {{ $paciente->nombre }} {{ $paciente->apellido }}</h1>
    <a href="{{ route('pacientes.tratamientos.listar', $paciente->id) }}" class="btn btn-secondary show-spinner">← Volver</a>
</div>

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

@if($pets->isEmpty())
    <div class="alert alert-warning">
        No hay <strong>Tipos de PET</strong> activos. 
        <a href="{{ route('tipos-pet.crear') }} " class="show-spinner">Crear un Tipo de PET</a>
    </div>
@else
    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('pacientes.tratamientos.guardar', $paciente->id) }}" method="POST" id="tratamientoForm">
                @csrf

                {{-- Tipo de PET --}}
                <div class="mb-3">
                    <label for="pets_id" class="form-label">Tipo de PET</label>
                    <select name="pets_id" id="pets_id" class="form-select" required
                            oninvalid="this.setCustomValidity('Debe seleccionar un Tipo de PET')"
                            oninput="this.setCustomValidity('')">
                        <option value="">Seleccione...</option>
                        @foreach($pets as $pet)
                            <option value="{{ $pet->id }}" {{ old('pets_id') == $pet->id ? 'selected' : '' }}>
                                {{ $pet->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Fecha de inicio --}}
                <div class="mb-3">
                    <label for="fecha_inicio" class="form-label">Fecha de inicio</label>
                    <input type="date"
                           name="fecha_inicio"
                           id="fecha_inicio"
                           class="form-control"
                           value="{{ old('fecha_inicio') }}"
                           max="{{ now()->format('Y-m-d') }}"  {{-- opcional: no permitir futuro --}}
                           required
                           oninvalid="this.setCustomValidity('Debe ingresar la fecha de inicio')"
                           oninput="this.setCustomValidity('')">
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('pacientes.tratamientos.listar', $paciente->id) }}" class="btn btn-secondary me-2 show-spinner">Cancelar</a>
                    <button type="submit" class="btn btn-success show-spinner">Guardar </button>
                </div>
            </form>
        </div>
    </div>

@endif
@include('components.spinner')
@endsection