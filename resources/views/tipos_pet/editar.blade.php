@extends('layouts.app')

@section('title', 'Editar Tipo de PET')

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Editar Tipo de PET</h4>
    </div>
    <div class="card-body">

        {{-- Errores --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Ups!</strong> Corrige los errores:
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulario --}}
        <form action="{{ route('tipos-pet.actualizar', $tipoPet->id) }}" method="POST" id="tipo-petForm">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control"
                       value="{{ old('nombre', $tipoPet->nombre) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Color</label>
                <select name="color" class="form-select" required>
                    <option value="verde" {{ old('color', $tipoPet->color) == 'verde' ? 'selected' : '' }}>Verde</option>
                    <option value="amarillo" {{ old('color', $tipoPet->color) == 'amarillo' ? 'selected' : '' }}>Amarillo</option>
                    <option value="ambar" {{ old('color', $tipoPet->color) == 'ambar' ? 'selected' : '' }}>Ámbar</option>
                    <option value="rojo" {{ old('color', $tipoPet->color) == 'rojo' ? 'selected' : '' }}>Rojo</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Intensidad (1-10)</label>
                <input type="number" name="intensidad" min="1" max="10"
                       class="form-control"
                       value="{{ old('intensidad', $tipoPet->intensidad) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Duración (minutos)</label>
                <input type="number" name="duracion_minutos" min="1"
                       class="form-control"
                       value="{{ old('duracion_minutos', $tipoPet->duracion_minutos) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Requiere ayuno</label>
                <select name="requiere_ayuno" class="form-select" required>
                    <option value="1" {{ old('requiere_ayuno', $tipoPet->requiere_ayuno) ? 'selected' : '' }}>Sí</option>
                    <option value="0" {{ old('requiere_ayuno', $tipoPet->requiere_ayuno) == 0 ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Observaciones</label>
                <textarea name="observaciones" class="form-control">{{ old('observaciones', $tipoPet->observaciones) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Estado</label>
                <select name="activo" class="form-select" required>
                    <option value="1" {{ old('activo', $tipoPet->activo) ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ old('activo', $tipoPet->activo) == 0 ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('tipos-pet.listar') }}" class="btn btn-secondary me-2">Cancelar</a>
                <button type="submit" class="btn btn-primary" id="btnGuardar" disabled>Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('tipo-petForm');
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