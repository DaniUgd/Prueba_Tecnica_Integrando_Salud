@extends('layouts.app')

@section('title', 'Listado de Tipos de PET')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Listado de Tipos de PET</h1>
    <a href="{{ route('tipos-pet.crear') }}" class="btn btn-success show-spinner">+ Nuevo Tipo de PET</a>
</div>

{{-- Mensajes --}}
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

{{-- Filtro de estado --}}
<form method="GET" action="{{ route('tipos-pet.listar') }}" class="row g-3 mb-3">
    <h6>Filtrar por Estado</h6>
    <div class="col-md-4">
        <select name="estado" class="form-select show-spinner-onchange" onchange="this.form.submit() ">
            <option value="activos" {{ $estado === 'activos' ? 'selected' : '' }}>Activos</option>
            <option value="inactivos" {{ $estado === 'inactivos' ? 'selected' : '' }}>Inactivos</option>
            <option value="todos" {{ $estado === 'todos' ? 'selected' : '' }}>Todos</option>
        </select>
    </div>
</form>

{{-- Tabla --}}
<table class="table table-bordered table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>Nombre</th>
            <th>Color</th>
            <th>Intensidad</th>
            <th>Duración (min)</th>
            <th>Requiere Ayuno</th>
            <th>Observaciones</th>
            <th>Estado</th>
            <th class="text-center">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($tipos as $tipo)
            <tr>
                <td>{{ $tipo->nombre }}</td>
                <td>{{ ucfirst($tipo->color) }}</td>
                <td>{{ $tipo->intensidad }}</td>
                <td>{{ $tipo->duracion_minutos }}</td>
                <td>{{ $tipo->requiere_ayuno ? 'Sí' : 'No' }}</td>
                <td>{{ $tipo->observaciones }}</td>
                <td>
                    @if($tipo->activo)
                        <span class="badge bg-success">Activo</span>
                    @else
                        <span class="badge bg-danger">Inactivo</span>
                    @endif
                </td>
                <td class="text-center">
                    <a href="{{ route('tipos-pet.editar', $tipo->id) }}" class="btn btn-sm btn-primary show-spinner">Editar</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" class="text-center">No se encontraron tipos de PET</td>
            </tr>
        @endforelse
    </tbody>
</table>
<a href="{{ route('inicio') }}" class="btn btn-secondary show-spinner">← Volver a inicio</a>
@include('components.spinner')
@endsection