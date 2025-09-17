@extends('layouts.app')

@section('title', 'Tratamientos de ' . $paciente->nombre . ' ' . $paciente->apellido)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">
        Tratamientos de {{ $paciente->nombre }} {{ $paciente->apellido }}
    </h1>
    <a href="{{ route('pacientes.tratamientos.crear', $paciente->id) }}"class="btn btn-success show-spinner">
    + Nuevo Tratamiento
    </a>
</div>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
  <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<table class="table table-bordered table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Tipo de PET</th>
            <th>Fecha de inicio</th>
        </tr>
    </thead>
    <tbody>
        @forelse($tratamientos as $t)
            <tr>
                <td>{{ $t->id }}</td>
                <td>{{ $t->pet?->nombre ?? '—' }}</td>
                <td>{{ $t->fecha_inicio }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center">Este paciente no tiene tratamientos cargados</td>
            </tr>
        @endforelse
    </tbody>
</table>

<a href="{{ route('pacientes.listar') }}" class="btn btn-secondary show-spinner">← Volver a Pacientes</a>

@include('components.spinner')
@endsection