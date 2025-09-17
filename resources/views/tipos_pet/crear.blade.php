@extends('layouts.app')

@section('title', 'Nuevo Tipo de PET')

@section('content')
<div class="card shadow">
    <div class="card-header bg-success text-white">
        <h4 class="mb-0">Registrar Nuevo Tipo de PET</h4>
    </div>
    <div class="card-body">

        {{-- Errores --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                Hay errores en el formulario:
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulario --}}
        <form action="{{ route('tipos-pet.guardar') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Color</label>
                <select name="color" class="form-select" required>
                    <option value="">Seleccione...</option>
                    <option value="verde">Verde</option>
                    <option value="amarillo">Amarillo</option>
                    <option value="ambar">Ámbar</option>
                    <option value="rojo">Rojo</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Intensidad (1-10)</label>
                <input type="number" name="intensidad" min="1" max="10" class="form-control" value="{{ old('intensidad') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Duración (minutos)</label>
                <input type="number" name="duracion_minutos" min="1" class="form-control" value="{{ old('duracion_minutos') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Requiere ayuno</label>
                <select name="requiere_ayuno" class="form-select" required>
                    <option value="">Seleccione...</option>
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Observaciones</label>
                <textarea name="observaciones" class="form-control">{{ old('observaciones') }}</textarea>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('tipos-pet.listar') }}" class="btn btn-secondary me-2">Cancelar</a>
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection